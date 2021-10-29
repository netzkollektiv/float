
import { Placeholder, Spinner, RangeControl } from '@wordpress/components';
import { WithState } from '@wordpress/compose';
import { Columns } from '@wordpress/icons';
import { SearchListControl } from '@woocommerce/components';

import uniqueID from '../global';
const { addQueryArgs } = wp.url;
const { Component, Fragment } = wp.element;
const { apiFetch } = wp;
const { PanelBody, ToggleControl } = wp.components;
const { InspectorControls, BlockControls } = wp.blockEditor;
const { __ } = wp.i18n;

export class Edit extends Component {

	constructor( props ) {
		super( ...props );

		this.state = {
				loading: false,
				cat_list: [],
				items: [],
		};
		this.generateID = this.generateID.bind( this );
		this.getItems = this.getItems.bind( this );
		this.renderCategory = this.renderCategory.bind( this );
		this.getSearchList = this.getSearchList.bind( this );
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

	renderCategory( category ){
		const self = this;
		let count = '';
		if (self.props.attributes.is_count_visible) {
			count =  <span className="pure-fashion-wc-category-count">{category.count}</span>;
		}
		return (
			<div className={'columns ' + self.props.attributes.thbcolumns }>
				<div className="pure-fashion-wc-category">
					<div className="pure-fashion-wc-category-image"><img src={category.image} /></div>

					<div className="pure-fashion-wc-category-title">{category.name}
					{count}
					</div>
				</div>
			</div>
		)
	}
	getSearchList(){
		let self = this;

		return(
				<SearchListControl
						list = { self.state.cat_list }
						selected = { self.props.attributes.categories }
						isLoading = { self.state.loading }
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
	render(){
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
				thbcolumns,
		} = attributes;

		const classes = [ 'pure-fashion', 'pure-fashion-woo-category-grid', self.props.className ];

		if ( categories && ! categories.length ) {
				classes.push( 'is-loading' );
		}
		const ThbColumnControl = WithState( {
				columns: thbcolumns,
		} )( ( { columns, setState } ) => (
				<RangeControl
						label="Columns"
						value={ columns }
						onChange={ ( columns ) => {
							setState( { columns } );
							setAttributes( { thbcolumns: columns } );
						}}
						min={ 1 }
						max={ 6 }
				/>
		) );

		const ThbCountControl = WithState( {
				hasCount: is_count_visible,
		} )( ( { hasCount, setState } ) => (
				<ToggleControl
						label="Display Count"
						checked={ hasCount }
						onChange={ ( hasCount ) => {
							setState( { hasCount } );
							setAttributes( { is_count_visible: hasCount } );
						}}
				/>
		) );
		let itemsOutput;

		if ( items.length ){
			itemsOutput = <div className = {'row'} data-columns={thbcolumns} >{items.map( item => this.renderCategory( item, thbcolumns ) )}</div>;
		} else {
			itemsOutput = <Placeholder
				icon = { Columns }
				label = { __( 'WooCommerce Category Grid', 'pure-fashion' ) }
				instructions= { __('Please select WooCommerce Categories', 'pure-fashion') }
				/>;
		}

		return [

				isSelected && (
					<InspectorControls key = {'inspector'} >
						<PanelBody
							title={ __('Categories', 'pure-fashion') }
							initialOpen={ true }
						>
							<SearchListControl
								list = { cat_list }
								selected = { categories }
								isLoading = { self.state.loading }
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
							<ThbColumnControl />
							<ThbCountControl />
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

		]
	}
}
