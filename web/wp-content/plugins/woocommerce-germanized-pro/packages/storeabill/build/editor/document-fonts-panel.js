this.sab=this.sab||{},this.sab.blocks=this.sab.blocks||{},this.sab.blocks["document-fonts-panel"]=function(e){function t(t){for(var r,a,i=t[0],l=t[1],u=t[2],f=0,d=[];f<i.length;f++)a=i[f],Object.prototype.hasOwnProperty.call(o,a)&&o[a]&&d.push(o[a][0]),o[a]=0;for(r in l)Object.prototype.hasOwnProperty.call(l,r)&&(e[r]=l[r]);for(s&&s(t);d.length;)d.shift()();return c.push.apply(c,u||[]),n()}function n(){for(var e,t=0;t<c.length;t++){for(var n=c[t],r=!0,i=1;i<n.length;i++){var l=n[i];0!==o[l]&&(r=!1)}r&&(c.splice(t--,1),e=a(a.s=n[0]))}return e}var r={},o={7:0,38:0},c=[];function a(t){if(r[t])return r[t].exports;var n=r[t]={i:t,l:!1,exports:{}};return e[t].call(n.exports,n,n.exports,a),n.l=!0,n.exports}a.m=e,a.c=r,a.d=function(e,t,n){a.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(e,t){if(1&t&&(e=a(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(a.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)a.d(n,r,function(t){return e[t]}.bind(null,r));return n},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,"a",t),t},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.p="";var i=window.webpackStoreaBillJsonp=window.webpackStoreaBillJsonp||[],l=i.push.bind(i);i.push=t,i=i.slice();for(var u=0;u<i.length;u++)t(i[u]);var s=l;return c.push([104,1,0]),n()}({0:function(e,t){e.exports=window.wp.element},1:function(e,t){e.exports=window.lodash},104:function(e,t,n){"use strict";n.r(t);var r=n(0),o=(n(29),n(8)),c=n(6),a=n(19),i=n(3),l=n(1),u=n(9),s=n(4),f=n.n(s),d=n(33),p=n.n(d),b=n(34),m=n.n(b),g=n(27),h=n.n(g),v=n(35),O=n.n(v),y=n(36),j=n.n(y),w=n(28),C=n.n(w),S=n(10),T=n.n(S);n(62);function P(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],(function(){}))),!0}catch(e){return!1}}();return function(){var n,r=C()(e);if(t){var o=C()(this).constructor;n=Reflect.construct(r,arguments,o)}else n=r.apply(this,arguments);return j()(this,n)}}var k=function(e){return e.stopPropagation()},_=function(e){O()(n,e);var t=P(n);function n(){var e;return p()(this,n),(e=t.apply(this,arguments)).state={filterValue:"",hoveredItem:null,filteredItems:[],showResults:!1},e.availableFonts=Object(u.getFonts)(),e.onChangeSearchInput=e.onChangeSearchInput.bind(h()(e)),e.onChangeFont=e.onChangeFont.bind(h()(e)),e.onChangeFontVariants=e.onChangeFontVariants.bind(h()(e)),e.onClickCurrentFont=e.onClickCurrentFont.bind(h()(e)),e}return m()(n,[{key:"componentDidMount",value:function(){}},{key:"componentDidUpdate",value:function(e){e.filteredItems!==this.props.filteredItems&&this.filter(this.state.filterValue)}},{key:"onChangeSearchInput",value:function(e){this.filter(e.target.value)}},{key:"filter",value:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"";if(""!==e){var t=this.availableFonts.filter((function(t){var n=t.label;t.variations;if(n.toLowerCase().startsWith(e.toLowerCase()))return!0}));this.setState({filterValue:e,filteredItems:t,showResults:!0})}else this.setState({filterValue:e,filteredItems:[],showResults:!1})}},{key:"onClickCurrentFont",value:function(e){var t=this.props.currentFont;this.filter(t.label)}},{key:"onChangeFont",value:function(e){var t=this.props.currentFont;t&&t.name===e.name||this.props.onUpdateFont(e.name,{regular:"regular"})}},{key:"onChangeFontVariants",value:function(e){this.props.onUpdateFont(this.props.currentFont.name,e)}},{key:"render",value:function(){var e=this.state,t=e.filteredItems,n=e.filterValue,c=e.showResults,a=this.props,s=a.currentFont,d=a.currentFontVariants,p=a.displayType,b=(Object(l.isEmpty)(t),this.onChangeFont),m=this.onChangeFontVariants,g=Object(u.getSetting)("fontDisplayTypes")[p],h=Object(u.getSetting)("fontVariationTypes"),v=Object(u.getSetting)("defaultFont"),O=v?Object(u.getFont)(v.name):{};return Object(r.createElement)("div",{className:"sab-fonts-wrapper"},Object(r.createElement)("label",{className:"fonts-wrapper-label"},Object(r.createElement)("span",{className:"inner-label"},g.title),s&&Object(r.createElement)("span",{className:"current-font",onClick:this.onClickCurrentFont},s.label),!s&&O&&Object(r.createElement)("span",{className:"current-font default-font"},O.label)),Object(r.createElement)("div",{className:"sab-fonts-search",onKeyPress:k},Object(r.createElement)("div",{className:"font-list-wrapper"},Object(r.createElement)("input",{type:"search",placeholder:Object(i._x)("Search for a font","storeabill-core","woocommerce-germanized-pro"),className:"font-search",autoFocus:!0,value:n,onChange:this.onChangeSearchInput}),Object(r.createElement)("div",{className:"font-results",tabIndex:"0",role:"region","aria-label":Object(i._x)("Available fonts","storeabill-core","woocommerce-germanized-pro")},c&&Object(r.createElement)("ul",{role:"list",className:"font-list"},t.map((function(e){return Object(r.createElement)("li",{className:T()("font-family",f()({},"active",s&&s.name===e.name)),onClick:function(t){t.preventDefault(),b(e)},key:e.name},Object(r.createElement)("span",{className:"font-title"},e.label),!Object(l.isEmpty)(e.variants)&&s&&e.name===s.name&&Object(r.createElement)("ul",{className:"font-variants"},Object.keys(h).map((function(t,n){var c=d.hasOwnProperty(t)?d[t]:"regular";return Object(r.createElement)("li",{className:"font-variant-select",key:n},Object(r.createElement)(o.SelectControl,{label:h[t],value:c,options:e.variants.map((function(e){return{label:h.hasOwnProperty(e)?h[e]:e,value:e}})),onChange:function(e){m(f()({},t,e))}}))}))))})))))))}}]),n}(r.Component),E=Object(c.withSelect)((function(e,t){var n=t.displayType,r=(0,e("core/editor").getEditedPostAttribute)("meta"),o=Object(l.isEmpty)(r._fonts)?{}:r._fonts,c=o&&o[n]?o[n]:void 0;return{currentFont:c?Object(u.getFont)(c.name):void 0,currentFontVariants:c?c.variants:{}}})),x=Object(c.withDispatch)((function(e,t,n){var r=t.displayType,o=n.select,c=e("core/editor").editPost,a=(0,o("core/editor").getEditedPostAttribute)("meta"),i=a._fonts&&!Object(l.isEmpty)(a._fonts)?Object(l.cloneDeep)(a._fonts):{};return{onUpdateFont:function(e,t){var n=i[r]?i[r].name:"";i[r]&&n!==e&&(i[r].variants={});var o=Object(l.merge)(i[r]?i[r].variants:{},t);i[r]={name:e,variants:o},c({meta:{_fonts:i}})}}})),F=Object(a.compose)(E,x)(_),N=n(7),D=n(30),A=n(31);var I=Object(c.withSelect)((function(e){var t=(0,e("core/editor").getEditedPostAttribute)("meta");return{fontSize:t._font_size?t._font_size:Object(u.getSetting)("defaultFontSize"),color:t._color?t._color:Object(u.getSetting)("defaultColor")}})),B=Object(c.withDispatch)((function(e){var t=e("core/editor").editPost;return{onUpdateFontSize:function(e){t({meta:{_font_size:e?e.toString():""}})},onUpdateColor:function(e){t({meta:{_color:e?e.hex:Object(u.getSetting)("defaultColor")}})}}})),M=Object(a.compose)(I,B)((function(e){var t=e.fontSize,n=e.onUpdateFontSize,c=e.color,a=e.onUpdateColor,l=Object(u.getSetting)("fontDisplayTypes");return Object(r.createElement)(D.PluginDocumentSettingPanel,{name:"sab-fonts-panel",title:Object(i._x)("Typography","storeabill-core","woocommerce-germanized-pro"),className:"sab-fonts-panel"},Object(r.createElement)(o.PanelRow,null,Object(r.createElement)(o.ColorPicker,{color:c,onChangeComplete:a,disableAlpha:!0})),Object(r.createElement)(o.PanelRow,null,Object(r.createElement)(o.FontSizePicker,{fontSizes:Object(u.getSetting)("customFontSizes"),value:Object(N.a)(t),onChange:n,withSlider:!1,fallbackFontSize:Object(u.getSetting)("defaultFontSize")})),Object(r.createElement)(o.PanelRow,{className:"sab-fonts-panel-row"},Object.keys(l).map((function(e,t){return Object(r.createElement)(F,{key:e,displayType:e})}))))}));Object(u.getSetting)("isFirstPage")||Object(A.registerPlugin)("storeabill-fonts-panel",{render:M,icon:""})},12:function(e,t){e.exports=window.wp.apiFetch},13:function(e,t){e.exports=window.wp.url},19:function(e,t){e.exports=window.wp.compose},2:function(e,t){e.exports=window.wp.blockEditor},29:function(e,t){e.exports=window.wp.domReady},3:function(e,t){e.exports=window.wp.i18n},30:function(e,t){e.exports=window.wp.editPost},31:function(e,t){e.exports=window.wp.plugins},6:function(e,t){e.exports=window.wp.data},62:function(e,t,n){},7:function(e,t,n){"use strict";var r=n(1),o=n(2),c=n(20),a=n.n(c),i=n(18),l=n.n(i),u=n(4),s=n.n(u),f=n(0),d=n(21),p=n.n(d),b=n(10),m=n.n(b),g=n(3),h=n(6),v=n(14),O=n.n(v),y=n(17),j=n.n(y),w=["backgroundColor","textColor"],C=function(e,t,n){return"function"==typeof e?e(t):!0===e?n:e};function S(e){var t=e.title,n=e.colorSettings,c=e.colorPanelProps,a=e.contrastCheckers,i=e.detectedBackgroundColor,l=e.detectedColor,u=e.panelChildren,s=e.initialOpen;return Object(f.createElement)(o.PanelColorSettings,O()({title:t,initialOpen:s,colorSettings:Object.values(n)},c),a&&(Array.isArray(a)?a.map((function(e){var t=e.backgroundColor,r=e.textColor,c=j()(e,w);return t=C(t,n,i),r=C(r,n,l),Object(f.createElement)(o.ContrastChecker,O()({key:"".concat(t,"-").concat(r),backgroundColor:t,textColor:r},c))})):Object(r.map)(n,(function(e){var t=e.value,r=a.backgroundColor,c=a.textColor;return r=C(r||t,n,i),c=C(c||t,n,l),Object(f.createElement)(o.ContrastChecker,O()({},a,{key:"".concat(r,"-").concat(c),backgroundColor:r,textColor:c}))}))),"function"==typeof u?u(n):u)}function T(e,t){var n="undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(!n){if(Array.isArray(e)||(n=function(e,t){if(!e)return;if("string"==typeof e)return P(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);"Object"===n&&e.constructor&&(n=e.constructor.name);if("Map"===n||"Set"===n)return Array.from(e);if("Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n))return P(e,t)}(e))||t&&e&&"number"==typeof e.length){n&&(e=n);var r=0,o=function(){};return{s:o,n:function(){return r>=e.length?{done:!0}:{done:!1,value:e[r++]}},e:function(e){throw e},f:o}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var c,a=!0,i=!1;return{s:function(){n=n.call(e)},n:function(){var e=n.next();return a=e.done,e},e:function(e){i=!0,c=e},f:function(){try{a||null==n.return||n.return()}finally{if(i)throw c}}}}function P(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,r=new Array(t);n<t;n++)r[n]=e[n];return r}function k(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function _(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?k(Object(n),!0).forEach((function(t){s()(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):k(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function E(e){return e.ownerDocument.defaultView.getComputedStyle(e)}var x=[],F={textColor:Object(g.__)("Text color"),backgroundColor:Object(g.__)("Background color")},N=function(e){return Object(f.createElement)(o.InspectorControls,null,Object(f.createElement)(S,e))};n.d(t,"g",(function(){return D})),n.d(t,"b",(function(){return A})),n.d(t,"a",(function(){return I})),n.d(t,"c",(function(){return B})),n.d(t,"e",(function(){return M})),n.d(t,"d",(function(){return z})),n.d(t,"f",(function(){return R}));var D=void 0===o.__experimentalUseColors?function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{panelTitle:Object(g.__)("Color")},n=t.panelTitle,c=void 0===n?Object(g.__)("Color"):n,i=t.colorPanelProps,u=t.contrastCheckers,d=t.panelChildren,b=t.colorDetector,v=(b=void 0===b?{}:b).targetRef,O=b.backgroundColorTargetRef,y=void 0===O?v:O,j=b.textColorTargetRef,w=void 0===j?v:j,C=arguments.length>2&&void 0!==arguments[2]?arguments[2]:[],P=Object(o.useBlockEditContext)(),k=P.clientId,D=Object(o.useSetting)("color.palette")||x,A=Object(h.useSelect)((function(e){return{attributes:(0,e(o.store).getBlockAttributes)(k)}}),[k]),I=A.attributes,B=Object(h.useDispatch)(o.store),M=B.updateBlockAttributes,z=Object(f.useCallback)((function(e){return M(k,e)}),[M,k]),R=Object(f.useMemo)((function(){return p()((function(e,t,n,o,c,a){return function(i){var l,u=i.children,d=i.className,p=void 0===d?"":d,b=i.style,g=void 0===b?{}:b,h={};o?h=s()({},t,c):a&&(h=s()({},t,a));var v={className:m()(p,(l={},s()(l,"has-".concat(Object(r.kebabCase)(o),"-").concat(Object(r.kebabCase)(t)),o),s()(l,n||"has-".concat(Object(r.kebabCase)(e)),o||a),l)),style:_(_({},h),g)};return Object(r.isFunction)(u)?u(v):f.Children.map(u,(function(e){return Object(f.cloneElement)(e,{className:m()(e.props.className,v.className),style:_(_({},v.style),e.props.style||{})})}))}}),{maxSize:e.length})}),[e.length]),V=Object(f.useMemo)((function(){return p()((function(e,t){return function(n){var o=t.find((function(e){return e.color===n}));z(s()({},o?Object(r.camelCase)("custom ".concat(e)):e,void 0)),z(s()({},o?e:Object(r.camelCase)("custom ".concat(e)),o?o.slug:n))}}),{maxSize:e.length})}),[z,e.length]),L=Object(f.useState)(),U=l()(L,2),Y=U[0],H=U[1],K=Object(f.useState)(),q=l()(K,2),J=q[0],Q=q[1];return Object(f.useEffect)((function(){if(u){var e,t=!1,n=!1,o=T(Object(r.castArray)(u));try{for(o.s();!(e=o.n()).done;){var c=e.value,a=c.backgroundColor,i=c.textColor;if(t||(t=!0===a),n||(n=!0===i),t&&n)break}}catch(e){o.e(e)}finally{o.f()}if(n&&Q(E(w.current).color),t){for(var l=y.current,s=E(l).backgroundColor;"rgba(0, 0, 0, 0)"===s&&l.parentNode&&l.parentNode.nodeType===l.parentNode.ELEMENT_NODE;)s=E(l=l.parentNode).backgroundColor;H(s)}}}),[e.reduce((function(e,t){return"".concat(e," | ").concat(I[t.name]," | ").concat(I[Object(r.camelCase)("custom ".concat(t.name))])}),"")].concat(a()(C))),Object(f.useMemo)((function(){var t={},n=e.reduce((function(e,n){"string"==typeof n&&(n={name:n});var o=_(_({},n),{},{color:I[n.name]}),c=o.name,a=o.property,i=void 0===a?c:a,l=o.className,u=o.panelLabel,s=void 0===u?n.label||F[c]||Object(r.startCase)(c):u,f=o.componentName,d=void 0===f?Object(r.startCase)(c).replace(/\s/g,""):f,p=o.color,b=void 0===p?n.color:p,m=o.colors,g=void 0===m?D:m,h=I[Object(r.camelCase)("custom ".concat(c))],v=h?void 0:g.find((function(e){return e.slug===b}));return e[d]=R(c,i,l,b,v&&v.color,h),e[d].displayName=d,e[d].color=h||v&&v.color,e[d].slug=b,e[d].setColor=V(c,g),t[d]={value:v?v.color:I[Object(r.camelCase)("custom ".concat(c))],onChange:e[d].setColor,label:s,colors:g},g||delete t[d].colors,e}),{}),o={title:c,initialOpen:!1,colorSettings:t,colorPanelProps:i,contrastCheckers:u,detectedBackgroundColor:Y,detectedColor:J,panelChildren:d};return _(_({},n),{},{ColorPanel:Object(f.createElement)(S,o),InspectorControlsColorPanel:Object(f.createElement)(N,o)})}),[I,z,J,Y].concat(a()(C)))}:o.__experimentalUseColors;function A(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"";return'<span class="placeholder-content '+(Object(r.isEmpty)(t)?"":"sab-tooltip")+'" contenteditable="false" '+(Object(r.isEmpty)(t)?"":'data-tooltip="'+t+'"')+'><span class="editor-placeholder"></span>'+e+"</span>"}function I(e){return"string"==typeof e&&/^\d+$/.test(e)&&(e=parseInt(e)),e}function B(e){var t,n=e;return e&&e.hasOwnProperty("size")&&(n=e.size),n?(t=n,isNaN(parseFloat(t))||isNaN(t-0)?n:n+"px"):void 0}function M(e,t,n,o){var c=arguments.length>4&&void 0!==arguments[4]?arguments[4]:"";return e&&Object(r.includes)(e,n)||(e=Object(r.includes)(e,"{default}")?e.replace("{default}",o||A(n,c)):o||A(n,c)),e.replace(n,t)}function z(e,t,n){return e.replace(n,t)}function R(e,t){var n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"placeholder-content",r=arguments.length>3&&void 0!==arguments[3]&&arguments[3],o=(new DOMParser).parseFromString(e,"text/html"),c=!1;if((c=r?o.querySelectorAll("[data-shortcode='"+n+"']"):o.getElementsByClassName(n)).length>0){var a=c[0].getElementsByClassName("editor-placeholder");if(a.length>0){for(var i=a[0].nextSibling,l=[];i;)i!==a[0]&&l.push(i),i=i.nextSibling;l.forEach((function(e){a[0].parentNode.removeChild(e)})),a[0].insertAdjacentHTML("afterEnd",t)}else c[0].innerHTML='<span class="editor-placeholder"></span>'+t;c[0].classList.remove("document-shortcode-needs-refresh"),e=o.body.innerHTML}return e}},8:function(e,t){e.exports=window.wp.components},9:function(e,t,n){"use strict";n.r(t);var r=n(4),o=n.n(r),c=n(22);function a(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function i(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?a(Object(n),!0).forEach((function(t){o()(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):a(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}var l="object"===("undefined"==typeof sabSettings?"undefined":n.n(c)()(sabSettings))?sabSettings:{},u=i(i({},{itemTotalTypes:[],itemMetaTypes:[],itemTableBlockTypes:[],discountTotalTypes:{}}),l);function s(e){var t=arguments.length>1&&void 0!==arguments[1]&&arguments[1],n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:function(e){return e},r=u.hasOwnProperty(e)?u[e]:t;return n(r,t)}var f=n(3),d=u.itemTotalTypes,p=u.itemMetaTypes,b=u.itemTableBlockTypes,m=u.discountTotalTypes,g=["core/bold","core/italic","core/text-color","core/underline","storeabill/document-shortcode","storeabill/font-size"],h=n(6),v=n(1),O=n(12),y=n.n(O),j=n(13);n(8);function w(e,t){var n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:function(e){return e};u[e]=n(t)}function C(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"product";return p.hasOwnProperty(e)?p[e]:[]}function S(e,t){Array.isArray(t)||(t=[t]);var n=Object(h.select)("core/block-editor").getBlockParents(e);if(n.length>0){var r=Object(h.select)("core/block-editor").getBlock(n[0]);if(Object(v.includes)(t,r.name))return!0}return!1}function T(e){var t=s("supports");return Object(v.includes)(t,e)}function P(e){var t=s("defaultInnerBlocks");return t.hasOwnProperty(e)?t[e]:[]}function k(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"product",n=C(t),r=n.filter((function(t){if(e===t.type)return!0})),o=r.length>0?r[0].preview:"",c=E(t),a=c.meta_data.filter((function(t){if(e===t.key)return!0}));return a.length>0?a[0].value:o}function _(){return s("preview",{})}function E(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"product",t=_();return t[e+"_items"][0]}function x(e){var t=d.filter((function(t){if(e===t.type)return!0}));return t&&t[0]?t[0].default:""}function F(e){var t=d.filter((function(t){if(e===t.type)return!0}));return t&&t[0]?t[0].title:""}function N(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"total",t=_(),n=t.totals,r=n.filter((function(t){return t.type===e}));return r.length>0?r[0].total_formatted:0}function D(){var e=_().tax_items;return e.length>0?e[0].rate.percent:"{rate}"}function A(){return _().formatted_discount_notice}function I(){var e=_().fee_items;return e.length>0?e[0].name:"{name}"}function B(e,t){var n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"read",r={top:e.top?e.top:t.top,left:e.left?e.left:t.left,right:e.right?e.right:t.right,bottom:e.bottom?e.bottom:t.bottom};if("edit"===n){var o=s("marginTypesSupported"),c={};return o.forEach((function(e){c[e]=r[e]})),c}return r}function M(){return"document_template"===Object(h.select)("core/editor").getCurrentPostType()}function z(){return s("allowedBlockTypes")}function R(){var e=void 0,t=(0,Object(h.select)("core/block-editor").getBlocks)().filter((function(e){if("storeabill/document-styles"===e.name)return e}));return t.length>0&&(e=t[0]),e}function V(){return s("fonts")}function L(e){var t=V().filter((function(t){if(t.name===e)return!0}));if(!Object(v.isEmpty)(t))return t[0]}function U(){var e=(0,Object(h.select)("core/editor").getEditedPostAttribute)("meta");return e._fonts?e._fonts:void 0}function Y(e){e=e||U();var t=Object(j.addQueryArgs)("/sab/v1/preview_fonts/css",{fonts:e,display_types:s("fontDisplayTypes")});return y()({path:t})}function H(e){var t=!(arguments.length>1&&void 0!==arguments[1])||arguments[1],n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"",r=e;return"before_discounts"===n&&(r+="_subtotal",Object(v.includes)(e,"total")&&(r=e.replace("total","")),"total"===e&&(r="subtotal")),!1===t&&(Object(v.includes)(e,"_total")&&(r=r.replace("_total","")),r+="_net"),r+"_formatted"}function K(e){var t="";return"document"===e?t=Object(f._x)("Document","storeabill-core","woocommerce-germanized-pro"):"document_item"===e?t=Object(f._x)("Document Item","storeabill-core","woocommerce-germanized-pro"):"document_total"===e?t=Object(f._x)("Document Total","storeabill-core","woocommerce-germanized-pro"):"setting"===e&&(t=Object(f._x)("Settings","storeabill-core","woocommerce-germanized-pro")),t}function q(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"",t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"",n=arguments.length>2&&void 0!==arguments[2]&&arguments[2],r=s("shortcodes"),o=Object.entries(r),c=["blocks","setting"],a={};o.forEach((function(r,o){var i=r[0];if((!(e.length>0&&e!==i)||Object(v.includes)(c,i))&&("blocks"!==i||0!==t.length)){var l=[],u=K(i);if(Object(v.isArray)(r[1]))l=r[1].flat();else if(t.length>0){l=r[1].hasOwnProperty(t)?r[1][t]:[];var s=Object(h.select)("core/blocks").getBlockType(t);u=s?s.title:t}a.hasOwnProperty(i)||(a[i]={label:u,value:i,children:{}}),l.map((function(e){if(!a[i].children.hasOwnProperty(e.shortcode)){if(!n&&e.hasOwnProperty("headerFooterOnly")&&e.headerFooterOnly)return;a[i].children[e.shortcode]={value:e.shortcode,label:e.title}}}))}}));var i=[];return Object.entries(a).map((function(e){var t=Object.values(e[1].children).flat();Object(v.isEmpty)(t)||i.push({value:e[1].value,label:e[1].label,children:t})})),i}function J(e){var t=s("shortcodes"),n=Object.entries(t),r={};return n.forEach((function(e,t){(Object(v.isArray)(e[1])?e[1].flat():Object.values(e[1]).flat()).map((function(e){r.hasOwnProperty(e.shortcode)||(r[e.shortcode]=e)}))})),!!r.hasOwnProperty(e)&&r[e]}function Q(e){var t=J(e);return t?t.title:""}function $(){return s("dateTypes")}function W(){return s("barcodeTypes")}function G(){return s("barcodeCodeTypes")}function X(e){var t=s("dateTypes"),n=Object(f._x)("Date","storeabill-core","woocommerce-germanized-pro");return Object.entries(t).map((function(t){t[0]===e&&(n=t[1])})),n}function Z(e){var t=Object(j.addQueryArgs)("/sab/v1/preview_shortcodes",{query:e,document_type:s("documentType")});return y()({path:t})}n.d(t,"getItemMetaTypes",(function(){return C})),n.d(t,"blockHasParent",(function(){return S})),n.d(t,"documentTypeSupports",(function(){return T})),n.d(t,"getDefaultInnerBlocks",(function(){return P})),n.d(t,"getItemMetaTypePreview",(function(){return k})),n.d(t,"getPreview",(function(){return _})),n.d(t,"getPreviewItem",(function(){return E})),n.d(t,"getItemTotalTypeDefaultTitle",(function(){return x})),n.d(t,"getItemTotalTypeTitle",(function(){return F})),n.d(t,"getPreviewTotal",(function(){return N})),n.d(t,"getPreviewTaxRate",(function(){return D})),n.d(t,"getPreviewDiscountNotice",(function(){return A})),n.d(t,"getPreviewFeeName",(function(){return I})),n.d(t,"formatMargins",(function(){return B})),n.d(t,"isDocumentTemplate",(function(){return M})),n.d(t,"getAllowedBlockTypes",(function(){return z})),n.d(t,"getDocumentStylesBlock",(function(){return R})),n.d(t,"getFonts",(function(){return V})),n.d(t,"getFont",(function(){return L})),n.d(t,"getCurrentFonts",(function(){return U})),n.d(t,"getFontsCSS",(function(){return Y})),n.d(t,"getItemTotalKey",(function(){return H})),n.d(t,"getShortcodeCategoryTitle",(function(){return K})),n.d(t,"getAvailableShortcodeTree",(function(){return q})),n.d(t,"getShortcodeData",(function(){return J})),n.d(t,"getShortcodeTitle",(function(){return Q})),n.d(t,"getDateTypes",(function(){return $})),n.d(t,"getBarcodeTypes",(function(){return W})),n.d(t,"getBarcodeCodeTypes",(function(){return G})),n.d(t,"getDateTypeTitle",(function(){return X})),n.d(t,"getShortcodePreview",(function(){return Z})),n.d(t,"ITEM_TOTAL_TYPES",(function(){return d})),n.d(t,"ITEM_META_TYPES",(function(){return p})),n.d(t,"ITEM_TABLE_BLOCK_TYPES",(function(){return b})),n.d(t,"DISCOUNT_TOTAL_TYPES",(function(){return m})),n.d(t,"FORMAT_TYPES",(function(){return g})),n.d(t,"setSetting",(function(){return w})),n.d(t,"getSetting",(function(){return s}))}});