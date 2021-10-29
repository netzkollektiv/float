import { __experimentalUnitControl as UnitControl } from '@wordpress/components';
import { TextControl,SearchListControl } from '@woocommerce/components';
import { Placeholder } from '@wordpress/components';
import { Spinner } from '@wordpress/components';
import { withState } from '@wordpress/compose';

import uniqueID from '../global';
const { addQueryArgs } = wp.url;
const { Component, Fragment } = wp.element;
const { apiFetch } = wp;
const { PanelBody, ToggleControl } = wp.components;
const { InspectorControls, BlockControls, AlignmentToolbar } = wp.blockEditor;
const { __ } = wp.i18n;

export class Edit extends Component {

	constructor( props ) {
		super( ...props );

		this.state = {
			loading: false,
			cat_list: [],
			items: [],
		};


		const {
			setAttributes,
			attributes,
			isSelected,
		} = props;

		const {
			desktop_height,
			button_text,
		} = attributes;

		this.generateID = this.generateID.bind( this );
		this.getItems = this.getItems.bind( this );
		this.renderCategory = this.renderCategory.bind( this );
		this.getSearchList = this.getSearchList.bind( this );

		this.ThbHeightControl = withState( {
				d_height: desktop_height,
		} )( ( { d_height, setState } ) => (
			<UnitControl
					label = { __( 'Desktop Height', 'pure-fashion' ) }
					help = { __( 'This height value wont affect mobile screens', 'pure-fashion' ) }
					onChange={ ( d_height ) => {
						setState( { d_height } );
						setAttributes( { desktop_height: d_height } );
					}}
					value={ d_height }
				/>
		) );

		this.ThbTextControl = withState( {
				btn_label: button_text,
		} )( ( { btn_label, setState } ) => (
				<TextControl
					label={ __( 'Button Label', 'pure-fashion' ) }
					onChange={ ( btn_label ) => {
						setState( { btn_label } );
						setAttributes( { button_text: btn_label } );
					}}
					value={ btn_label }
				/>
		) );
	}

	componentDidMount() {

		const self = this;

		self.generateID();

		// Loads category list for the "Inspector"
		apiFetch({
				path: addQueryArgs( '/pure-fashion/v1/category_list', {} ),
		})
		.then( ( list ) => {
				self.setState( { cat_list: list, loading: false } );
		})
		.catch( () => {
				self.setState( { cat_list: [], loading: false } );
		});

		// Loads categories for the render
		self.getItems();
	}

	componentDidUpdate( prevProps ) {
		if ( prevProps.attributes[ 'categories' ] !== this.props.attributes[ 'categories' ] ){
			this.getItems();
		}
	}

	generateID(){
		const self = this;

		// fix for duplicating a block ( same uid )
		if ( self.props.attributes.uid !== '' ){
			const found_uid = document.querySelectorAll( '#' + self.props.attributes.uid );

			if ( found_uid.length > 1 ){
				self.props.setAttributes({ uid : uniqueID() });
			}
		}
		// create id
		else {
			self.props.setAttributes({
				uid : uniqueID()
			});
		}
	}

	getItems(){
		const self = this;
		apiFetch({
			path: addQueryArgs( '/pure-fashion/v1/categories', {
				categories: self.props.attributes.categories,
			}),
		})
		.then( ( categories ) => {
			self.setState( {
				items: categories,
				loading: false
			});
		})
		.catch( () => {
			self.setState({
				items: [],
				loading: true
			});
		});
	}

	renderCategory( category, index ){
		const self = this;
		let count, desc = '';
		if ( self.props.attributes.is_count_visible ) {
			count = <span className="pure-fashion-wc-category-count">{category.count}</span>;
		}
		if ( self.props.attributes.is_desc_visible ) {
			desc = <span className="pure-fashion-wc-category-description">{category.description}</span>;
		}
		const cat_html = category ? (
			<div className={'pure-fashion-wc-category thb-index-'+ index }>
				<div className="pure-fashion-wc-category-image"><img src={category.image} /></div>
				<div className="pure-fashion-wc-category-content">
					<h2 className="pure-fashion-wc-category-title">{category.name} {count}</h2>
					{desc}
					<a href={ category.url } className="btn white">{self.props.attributes.button_text}</a>
				</div>
			</div>
		) : (
			<div className={'pure-fashion-wc-category thb-no-category thb-index-'+ index }>

			</div>
		);
		return cat_html;
	}
	getSearchList(){
		let self = this;

		return(
				<SearchListControl
						list = { self.state.cat_list }
						selected = { self.props.attributes.categories }
						onChange = { ( value = [] ) => {
								self.props.setAttributes( { categories: value } );
						}}
						onSearch = { ( query ) => {

								apiFetch({
										path: addQueryArgs( '/pure-fashion/v1/category_list', {
												'query' : query
										}),
								})
								.then( ( list ) => {
										self.setState( { cat_list: list, loading: false } );
								})
								.catch( () => {
										self.setState( { cat_list: [], loading: false } );
								});

						}}
				></SearchListControl>
		)
	}
	render() {
		const self = this;

		const { cat_list, items, loading } = this.state;

		if ( loading ) {
			return <Spinner />;
		}

		const {
				setAttributes,
				attributes,
				isSelected,
		} = self.props;

		const {
				uid,
				categories,
				is_count_visible,
				is_desc_visible,
				alignment,
				desktop_height,
		} = attributes;
		const {
			ThbHeightControl,
			ThbTextControl,
		} = self;

		const classes = [ 'pure-fashion', 'pure-fashion-woo-category-grid', self.props.className ];

		if ( categories && ! categories.length ) {
				classes.push( 'is-loading' );
		}

		const ThbCountControl = withState( {
				hasCount: is_count_visible,
		} )( ( { hasCount, setState } ) => (
				<ToggleControl
						label = { __( 'Display Count', 'pure-fashion' ) }
						checked={ hasCount }
						onChange={ ( hasCount ) => {
							setState( { hasCount } );
							setAttributes( { is_count_visible: hasCount } );
						}}
				/>
		) );

		const ThbDescriptionControl = withState( {
				hasDesc: is_desc_visible,
		} )( ( { hasDesc, setState } ) => (
				<ToggleControl
						label = { __( 'Display Description', 'pure-fashion' ) }
						checked={ hasDesc }
						onChange={ ( hasDesc ) => {
							setState( { hasDesc } );
							setAttributes( { is_desc_visible: hasDesc } );
						}}
				/>
		) );
		let itemsOutput;
		let cat_items = items;
		var gridStyle = {
			height: desktop_height,
		};
		if ( items.length ) {
			if ( items.length < 4 ) {
				for ( let j = items.length; j < 4; j++ ){
						cat_items[j] = '';
				}
			} else if ( items.length > 4 ) {
				cat_items = items.slice(0, 4);
			}
			itemsOutput = <div className = {'thb-css-grid'} style = {gridStyle}>{cat_items.map(function( item, index ) {
				return self.renderCategory( item, index );
			})}</div>;
		} else {
			itemsOutput = <Placeholder
				label = { __( 'WooCommerce Category Grid', 'pure-fashion' ) }
				instructions= { __('Please select WooCommerce Categories', 'pure-fashion') }
				/>;
		}

		return [

				isSelected && (
					<BlockControls key = { 'controls' }>
							<AlignmentToolbar
									value={alignment}
									onChange={ ( nextAlign ) => setAttributes( { alignment: nextAlign } ) }
							/>
					</BlockControls>
				),

				isSelected && (
					<InspectorControls key = {'inspector'} >
						<PanelBody
							title={ __('Categories', 'pure-fashion') }
							initialOpen={ true }
						>
							<SearchListControl
								list = { cat_list }
								selected = { categories }
								onChange = { ( items ) => {
									setAttributes( { categories: items } )
								}}
								onSearch = { ( query ) => {
									apiFetch({
											path: addQueryArgs( '/pure-fashion/v1/category_list', {
													'query' : query
											}),
									})
									.then( ( list ) => {
											self.setState( { cat_list: list, loading: false } );
									})
									.catch( () => {
											self.setState( { cat_list: [], loading: false } );
									});
								}}
							></SearchListControl>

						</PanelBody>
						<PanelBody
							title={ __('Settings', 'pure-fashion') }
							initialOpen={ true }
						>
							<div
									className={ 'components-base-control' }
							>
								<ThbHeightControl />
							</div>
							<ThbCountControl />
							<ThbDescriptionControl />
							<ThbTextControl />
						</PanelBody>

					</InspectorControls>
				),

				<Fragment>
					<div
							id = { uid }
							className={ classes.join( ' ' ) }
					>
						{itemsOutput}
					</div>
				</Fragment>

		];
	}
}
