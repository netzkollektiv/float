this.sab=this.sab||{},this.sab.blocks=this.sab.blocks||{},this.sab.blocks.blocks=function(e){function t(t){for(var n,i,a=t[0],l=t[1],u=t[2],f=0,d=[];f<a.length;f++)i=a[f],Object.prototype.hasOwnProperty.call(o,i)&&o[i]&&d.push(o[i][0]),o[i]=0;for(n in l)Object.prototype.hasOwnProperty.call(l,n)&&(e[n]=l[n]);for(s&&s(t);d.length;)d.shift()();return c.push.apply(c,u||[]),r()}function r(){for(var e,t=0;t<c.length;t++){for(var r=c[t],n=!0,a=1;a<r.length;a++){var l=r[a];0!==o[l]&&(n=!1)}n&&(c.splice(t--,1),e=i(i.s=r[0]))}return e}var n={},o={4:0,38:0},c=[];function i(t){if(n[t])return n[t].exports;var r=n[t]={i:t,l:!1,exports:{}};return e[t].call(r.exports,r,r.exports,i),r.l=!0,r.exports}i.m=e,i.c=n,i.d=function(e,t,r){i.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},i.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},i.t=function(e,t){if(1&t&&(e=i(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(i.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var n in e)i.d(r,n,function(t){return e[t]}.bind(null,n));return r},i.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return i.d(t,"a",t),t},i.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},i.p="";var a=window.webpackStoreaBillJsonp=window.webpackStoreaBillJsonp||[],l=a.push.bind(a);a.push=t,a=a.slice();for(var u=0;u<a.length;u++)t(a[u]);var s=l;return c.push([57,1,0]),r()}({0:function(e,t){e.exports=window.wp.element},1:function(e,t){e.exports=window.lodash},12:function(e,t){e.exports=window.wp.apiFetch},13:function(e,t){e.exports=window.wp.url},16:function(e,t){e.exports=window.wp.blocks},2:function(e,t){e.exports=window.wp.blockEditor},29:function(e,t){e.exports=window.wp.domReady},3:function(e,t){e.exports=window.wp.i18n},38:function(e,t){e.exports=window.wp.hooks},57:function(e,t,r){"use strict";r.r(t);var n=r(20),o=r.n(n),c=r(16),i=r(6),a=r(29),l=r.n(a),u=r(3),s=r(9),f=r(7),d=r(38),b=r(1);r(58);function p(e){var t=e.length;e.map((function(e){"storeabill/footer"===e.name&&(0,Object(i.dispatch)("core/editor").moveBlockToPosition)(e.clientId,"","",t)}))}l()((function(){setTimeout((function(){if(Object(s.isDocumentTemplate)()){var e=Object(s.getDocumentStylesBlock)();if(e)jQuery("body").find(".sab-block-hider").remove(),jQuery("body").append('<style type="text/css" class="sab-block-hider">tr#block-navigation-block-'+e.clientId+" { display: none !important }</style>");else{var t=Object(c.createBlock)("storeabill/document-styles",{});Object(i.dispatch)("core/block-editor").insertBlock(t,null,"",!1),jQuery("body").find(".sab-block-hider").remove(),jQuery("body").append('<style type="text/css" class="sab-block-hider">tr#block-navigation-block-'+t.clientId+" { display: none !important }</style>")}var r=Object(i.select)("core/block-editor").getBlocks,n=r();p(n);Object(i.subscribe)((function(){var e=r();e.length!==n.length&&(n=e,p(e))}));var o=jQuery(".document-shortcode-needs-refresh");o.length>0&&o.each((function(){var e=jQuery(this);e.hide();var t=e.data("shortcode");Object(s.getShortcodePreview)(e.data("shortcode")).then((function(r){var n=r.content,o=r.shortcode,c=e.parents(".wp-block").data("block"),a=Object(i.select)("core/block-editor").getBlockAttributes(c);if(a.length>0)for(var l=0,u=Object.keys(a);l<u.length;l++){var s=u[l],d=a[s];("string"==typeof d||d instanceof String)&&d.includes(t)&&(d=Object(f.f)(d,Object(b.isEmpty)(n)?o:n,t,!0),a[s]=d,Object(i.dispatch)("core/block-editor").updateBlockAttributes(c,{key:d}))}e.show()}))}))}}),0)}));var g=["storeabill/header","storeabill/footer","storeabill/document-styles"];Object(d.addFilter)("blocks.registerBlockType","storeabill/show-hide-blocks",(function(e,t){return!Object(s.getSetting)("isFirstPage")||-1!==g.indexOf(t)||e.hasOwnProperty("parent")&&e.parent.toString()!==["core/post-content"].toString()?e:Object.assign({},e,{parent:["storeabill/header","storeabill/footer","core/column"]})})),Object(c.setCategories)([].concat(o()(Object(c.getCategories)().filter((function(e){return"storeabill"!==e.slug}))),[{slug:"storeabill",title:Object(u._x)("StoreaBill","storeabill-core","woocommerce-germanized-pro")}]))},58:function(e,t,r){},6:function(e,t){e.exports=window.wp.data},7:function(e,t,r){"use strict";var n=r(1),o=r(2),c=r(20),i=r.n(c),a=r(18),l=r.n(a),u=r(4),s=r.n(u),f=r(0),d=r(21),b=r.n(d),p=r(10),g=r.n(p),y=r(3),h=r(6),v=r(14),O=r.n(v),m=r(17),j=r.n(m),w=["backgroundColor","textColor"],k=function(e,t,r){return"function"==typeof e?e(t):!0===e?r:e};function T(e){var t=e.title,r=e.colorSettings,c=e.colorPanelProps,i=e.contrastCheckers,a=e.detectedBackgroundColor,l=e.detectedColor,u=e.panelChildren,s=e.initialOpen;return Object(f.createElement)(o.PanelColorSettings,O()({title:t,initialOpen:s,colorSettings:Object.values(r)},c),i&&(Array.isArray(i)?i.map((function(e){var t=e.backgroundColor,n=e.textColor,c=j()(e,w);return t=k(t,r,a),n=k(n,r,l),Object(f.createElement)(o.ContrastChecker,O()({key:"".concat(t,"-").concat(n),backgroundColor:t,textColor:n},c))})):Object(n.map)(r,(function(e){var t=e.value,n=i.backgroundColor,c=i.textColor;return n=k(n||t,r,a),c=k(c||t,r,l),Object(f.createElement)(o.ContrastChecker,O()({},i,{key:"".concat(n,"-").concat(c),backgroundColor:n,textColor:c}))}))),"function"==typeof u?u(r):u)}function C(e,t){var r="undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(!r){if(Array.isArray(e)||(r=function(e,t){if(!e)return;if("string"==typeof e)return P(e,t);var r=Object.prototype.toString.call(e).slice(8,-1);"Object"===r&&e.constructor&&(r=e.constructor.name);if("Map"===r||"Set"===r)return Array.from(e);if("Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r))return P(e,t)}(e))||t&&e&&"number"==typeof e.length){r&&(e=r);var n=0,o=function(){};return{s:o,n:function(){return n>=e.length?{done:!0}:{done:!1,value:e[n++]}},e:function(e){throw e},f:o}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var c,i=!0,a=!1;return{s:function(){r=r.call(e)},n:function(){var e=r.next();return i=e.done,e},e:function(e){a=!0,c=e},f:function(){try{i||null==r.return||r.return()}finally{if(a)throw c}}}}function P(e,t){(null==t||t>e.length)&&(t=e.length);for(var r=0,n=new Array(t);r<t;r++)n[r]=e[r];return n}function S(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function _(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?S(Object(r),!0).forEach((function(t){s()(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):S(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}function x(e){return e.ownerDocument.defaultView.getComputedStyle(e)}var E=[],B={textColor:Object(y.__)("Text color"),backgroundColor:Object(y.__)("Background color")},A=function(e){return Object(f.createElement)(o.InspectorControls,null,Object(f.createElement)(T,e))};r.d(t,"g",(function(){return D})),r.d(t,"b",(function(){return N})),r.d(t,"a",(function(){return I})),r.d(t,"c",(function(){return M})),r.d(t,"e",(function(){return F})),r.d(t,"d",(function(){return L})),r.d(t,"f",(function(){return Q}));var D=void 0===o.__experimentalUseColors?function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{panelTitle:Object(y.__)("Color")},r=t.panelTitle,c=void 0===r?Object(y.__)("Color"):r,a=t.colorPanelProps,u=t.contrastCheckers,d=t.panelChildren,p=t.colorDetector,v=(p=void 0===p?{}:p).targetRef,O=p.backgroundColorTargetRef,m=void 0===O?v:O,j=p.textColorTargetRef,w=void 0===j?v:j,k=arguments.length>2&&void 0!==arguments[2]?arguments[2]:[],P=Object(o.useBlockEditContext)(),S=P.clientId,D=Object(o.useSetting)("color.palette")||E,N=Object(h.useSelect)((function(e){return{attributes:(0,e(o.store).getBlockAttributes)(S)}}),[S]),I=N.attributes,M=Object(h.useDispatch)(o.store),F=M.updateBlockAttributes,L=Object(f.useCallback)((function(e){return F(S,e)}),[F,S]),Q=Object(f.useMemo)((function(){return b()((function(e,t,r,o,c,i){return function(a){var l,u=a.children,d=a.className,b=void 0===d?"":d,p=a.style,y=void 0===p?{}:p,h={};o?h=s()({},t,c):i&&(h=s()({},t,i));var v={className:g()(b,(l={},s()(l,"has-".concat(Object(n.kebabCase)(o),"-").concat(Object(n.kebabCase)(t)),o),s()(l,r||"has-".concat(Object(n.kebabCase)(e)),o||i),l)),style:_(_({},h),y)};return Object(n.isFunction)(u)?u(v):f.Children.map(u,(function(e){return Object(f.cloneElement)(e,{className:g()(e.props.className,v.className),style:_(_({},v.style),e.props.style||{})})}))}}),{maxSize:e.length})}),[e.length]),R=Object(f.useMemo)((function(){return b()((function(e,t){return function(r){var o=t.find((function(e){return e.color===r}));L(s()({},o?Object(n.camelCase)("custom ".concat(e)):e,void 0)),L(s()({},o?e:Object(n.camelCase)("custom ".concat(e)),o?o.slug:r))}}),{maxSize:e.length})}),[L,e.length]),z=Object(f.useState)(),Y=l()(z,2),H=Y[0],U=Y[1],q=Object(f.useState)(),J=l()(q,2),K=J[0],$=J[1];return Object(f.useEffect)((function(){if(u){var e,t=!1,r=!1,o=C(Object(n.castArray)(u));try{for(o.s();!(e=o.n()).done;){var c=e.value,i=c.backgroundColor,a=c.textColor;if(t||(t=!0===i),r||(r=!0===a),t&&r)break}}catch(e){o.e(e)}finally{o.f()}if(r&&$(x(w.current).color),t){for(var l=m.current,s=x(l).backgroundColor;"rgba(0, 0, 0, 0)"===s&&l.parentNode&&l.parentNode.nodeType===l.parentNode.ELEMENT_NODE;)s=x(l=l.parentNode).backgroundColor;U(s)}}}),[e.reduce((function(e,t){return"".concat(e," | ").concat(I[t.name]," | ").concat(I[Object(n.camelCase)("custom ".concat(t.name))])}),"")].concat(i()(k))),Object(f.useMemo)((function(){var t={},r=e.reduce((function(e,r){"string"==typeof r&&(r={name:r});var o=_(_({},r),{},{color:I[r.name]}),c=o.name,i=o.property,a=void 0===i?c:i,l=o.className,u=o.panelLabel,s=void 0===u?r.label||B[c]||Object(n.startCase)(c):u,f=o.componentName,d=void 0===f?Object(n.startCase)(c).replace(/\s/g,""):f,b=o.color,p=void 0===b?r.color:b,g=o.colors,y=void 0===g?D:g,h=I[Object(n.camelCase)("custom ".concat(c))],v=h?void 0:y.find((function(e){return e.slug===p}));return e[d]=Q(c,a,l,p,v&&v.color,h),e[d].displayName=d,e[d].color=h||v&&v.color,e[d].slug=p,e[d].setColor=R(c,y),t[d]={value:v?v.color:I[Object(n.camelCase)("custom ".concat(c))],onChange:e[d].setColor,label:s,colors:y},y||delete t[d].colors,e}),{}),o={title:c,initialOpen:!1,colorSettings:t,colorPanelProps:a,contrastCheckers:u,detectedBackgroundColor:H,detectedColor:K,panelChildren:d};return _(_({},r),{},{ColorPanel:Object(f.createElement)(T,o),InspectorControlsColorPanel:Object(f.createElement)(A,o)})}),[I,L,K,H].concat(i()(k)))}:o.__experimentalUseColors;function N(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"";return'<span class="placeholder-content '+(Object(n.isEmpty)(t)?"":"sab-tooltip")+'" contenteditable="false" '+(Object(n.isEmpty)(t)?"":'data-tooltip="'+t+'"')+'><span class="editor-placeholder"></span>'+e+"</span>"}function I(e){return"string"==typeof e&&/^\d+$/.test(e)&&(e=parseInt(e)),e}function M(e){var t,r=e;return e&&e.hasOwnProperty("size")&&(r=e.size),r?(t=r,isNaN(parseFloat(t))||isNaN(t-0)?r:r+"px"):void 0}function F(e,t,r,o){var c=arguments.length>4&&void 0!==arguments[4]?arguments[4]:"";return e&&Object(n.includes)(e,r)||(e=Object(n.includes)(e,"{default}")?e.replace("{default}",o||N(r,c)):o||N(r,c)),e.replace(r,t)}function L(e,t,r){return e.replace(r,t)}function Q(e,t){var r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"placeholder-content",n=arguments.length>3&&void 0!==arguments[3]&&arguments[3],o=(new DOMParser).parseFromString(e,"text/html"),c=!1;if((c=n?o.querySelectorAll("[data-shortcode='"+r+"']"):o.getElementsByClassName(r)).length>0){var i=c[0].getElementsByClassName("editor-placeholder");if(i.length>0){for(var a=i[0].nextSibling,l=[];a;)a!==i[0]&&l.push(a),a=a.nextSibling;l.forEach((function(e){i[0].parentNode.removeChild(e)})),i[0].insertAdjacentHTML("afterEnd",t)}else c[0].innerHTML='<span class="editor-placeholder"></span>'+t;c[0].classList.remove("document-shortcode-needs-refresh"),e=o.body.innerHTML}return e}},8:function(e,t){e.exports=window.wp.components},9:function(e,t,r){"use strict";r.r(t);var n=r(4),o=r.n(n),c=r(22);function i(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function a(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?i(Object(r),!0).forEach((function(t){o()(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):i(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}var l="object"===("undefined"==typeof sabSettings?"undefined":r.n(c)()(sabSettings))?sabSettings:{},u=a(a({},{itemTotalTypes:[],itemMetaTypes:[],itemTableBlockTypes:[],discountTotalTypes:{}}),l);function s(e){var t=arguments.length>1&&void 0!==arguments[1]&&arguments[1],r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:function(e){return e},n=u.hasOwnProperty(e)?u[e]:t;return r(n,t)}var f=r(3),d=u.itemTotalTypes,b=u.itemMetaTypes,p=u.itemTableBlockTypes,g=u.discountTotalTypes,y=["core/bold","core/italic","core/text-color","core/underline","storeabill/document-shortcode","storeabill/font-size"],h=r(6),v=r(1),O=r(12),m=r.n(O),j=r(13);r(8);function w(e,t){var r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:function(e){return e};u[e]=r(t)}function k(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"product";return b.hasOwnProperty(e)?b[e]:[]}function T(e,t){Array.isArray(t)||(t=[t]);var r=Object(h.select)("core/block-editor").getBlockParents(e);if(r.length>0){var n=Object(h.select)("core/block-editor").getBlock(r[0]);if(Object(v.includes)(t,n.name))return!0}return!1}function C(e){var t=s("supports");return Object(v.includes)(t,e)}function P(e){var t=s("defaultInnerBlocks");return t.hasOwnProperty(e)?t[e]:[]}function S(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"product",r=k(t),n=r.filter((function(t){if(e===t.type)return!0})),o=n.length>0?n[0].preview:"",c=x(t),i=c.meta_data.filter((function(t){if(e===t.key)return!0}));return i.length>0?i[0].value:o}function _(){return s("preview",{})}function x(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"product",t=_();return t[e+"_items"][0]}function E(e){var t=d.filter((function(t){if(e===t.type)return!0}));return t&&t[0]?t[0].default:""}function B(e){var t=d.filter((function(t){if(e===t.type)return!0}));return t&&t[0]?t[0].title:""}function A(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"total",t=_(),r=t.totals,n=r.filter((function(t){return t.type===e}));return n.length>0?n[0].total_formatted:0}function D(){var e=_().tax_items;return e.length>0?e[0].rate.percent:"{rate}"}function N(){return _().formatted_discount_notice}function I(){var e=_().fee_items;return e.length>0?e[0].name:"{name}"}function M(e,t){var r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"read",n={top:e.top?e.top:t.top,left:e.left?e.left:t.left,right:e.right?e.right:t.right,bottom:e.bottom?e.bottom:t.bottom};if("edit"===r){var o=s("marginTypesSupported"),c={};return o.forEach((function(e){c[e]=n[e]})),c}return n}function F(){return"document_template"===Object(h.select)("core/editor").getCurrentPostType()}function L(){return s("allowedBlockTypes")}function Q(){var e=void 0,t=(0,Object(h.select)("core/block-editor").getBlocks)().filter((function(e){if("storeabill/document-styles"===e.name)return e}));return t.length>0&&(e=t[0]),e}function R(){return s("fonts")}function z(e){var t=R().filter((function(t){if(t.name===e)return!0}));if(!Object(v.isEmpty)(t))return t[0]}function Y(){var e=(0,Object(h.select)("core/editor").getEditedPostAttribute)("meta");return e._fonts?e._fonts:void 0}function H(e){e=e||Y();var t=Object(j.addQueryArgs)("/sab/v1/preview_fonts/css",{fonts:e,display_types:s("fontDisplayTypes")});return m()({path:t})}function U(e){var t=!(arguments.length>1&&void 0!==arguments[1])||arguments[1],r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"",n=e;return"before_discounts"===r&&(n+="_subtotal",Object(v.includes)(e,"total")&&(n=e.replace("total","")),"total"===e&&(n="subtotal")),!1===t&&(Object(v.includes)(e,"_total")&&(n=n.replace("_total","")),n+="_net"),n+"_formatted"}function q(e){var t="";return"document"===e?t=Object(f._x)("Document","storeabill-core","woocommerce-germanized-pro"):"document_item"===e?t=Object(f._x)("Document Item","storeabill-core","woocommerce-germanized-pro"):"document_total"===e?t=Object(f._x)("Document Total","storeabill-core","woocommerce-germanized-pro"):"setting"===e&&(t=Object(f._x)("Settings","storeabill-core","woocommerce-germanized-pro")),t}function J(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"",t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"",r=arguments.length>2&&void 0!==arguments[2]&&arguments[2],n=s("shortcodes"),o=Object.entries(n),c=["blocks","setting"],i={};o.forEach((function(n,o){var a=n[0];if((!(e.length>0&&e!==a)||Object(v.includes)(c,a))&&("blocks"!==a||0!==t.length)){var l=[],u=q(a);if(Object(v.isArray)(n[1]))l=n[1].flat();else if(t.length>0){l=n[1].hasOwnProperty(t)?n[1][t]:[];var s=Object(h.select)("core/blocks").getBlockType(t);u=s?s.title:t}i.hasOwnProperty(a)||(i[a]={label:u,value:a,children:{}}),l.map((function(e){if(!i[a].children.hasOwnProperty(e.shortcode)){if(!r&&e.hasOwnProperty("headerFooterOnly")&&e.headerFooterOnly)return;i[a].children[e.shortcode]={value:e.shortcode,label:e.title}}}))}}));var a=[];return Object.entries(i).map((function(e){var t=Object.values(e[1].children).flat();Object(v.isEmpty)(t)||a.push({value:e[1].value,label:e[1].label,children:t})})),a}function K(e){var t=s("shortcodes"),r=Object.entries(t),n={};return r.forEach((function(e,t){(Object(v.isArray)(e[1])?e[1].flat():Object.values(e[1]).flat()).map((function(e){n.hasOwnProperty(e.shortcode)||(n[e.shortcode]=e)}))})),!!n.hasOwnProperty(e)&&n[e]}function $(e){var t=K(e);return t?t.title:""}function V(){return s("dateTypes")}function G(){return s("barcodeTypes")}function W(){return s("barcodeCodeTypes")}function X(e){var t=s("dateTypes"),r=Object(f._x)("Date","storeabill-core","woocommerce-germanized-pro");return Object.entries(t).map((function(t){t[0]===e&&(r=t[1])})),r}function Z(e){var t=Object(j.addQueryArgs)("/sab/v1/preview_shortcodes",{query:e,document_type:s("documentType")});return m()({path:t})}r.d(t,"getItemMetaTypes",(function(){return k})),r.d(t,"blockHasParent",(function(){return T})),r.d(t,"documentTypeSupports",(function(){return C})),r.d(t,"getDefaultInnerBlocks",(function(){return P})),r.d(t,"getItemMetaTypePreview",(function(){return S})),r.d(t,"getPreview",(function(){return _})),r.d(t,"getPreviewItem",(function(){return x})),r.d(t,"getItemTotalTypeDefaultTitle",(function(){return E})),r.d(t,"getItemTotalTypeTitle",(function(){return B})),r.d(t,"getPreviewTotal",(function(){return A})),r.d(t,"getPreviewTaxRate",(function(){return D})),r.d(t,"getPreviewDiscountNotice",(function(){return N})),r.d(t,"getPreviewFeeName",(function(){return I})),r.d(t,"formatMargins",(function(){return M})),r.d(t,"isDocumentTemplate",(function(){return F})),r.d(t,"getAllowedBlockTypes",(function(){return L})),r.d(t,"getDocumentStylesBlock",(function(){return Q})),r.d(t,"getFonts",(function(){return R})),r.d(t,"getFont",(function(){return z})),r.d(t,"getCurrentFonts",(function(){return Y})),r.d(t,"getFontsCSS",(function(){return H})),r.d(t,"getItemTotalKey",(function(){return U})),r.d(t,"getShortcodeCategoryTitle",(function(){return q})),r.d(t,"getAvailableShortcodeTree",(function(){return J})),r.d(t,"getShortcodeData",(function(){return K})),r.d(t,"getShortcodeTitle",(function(){return $})),r.d(t,"getDateTypes",(function(){return V})),r.d(t,"getBarcodeTypes",(function(){return G})),r.d(t,"getBarcodeCodeTypes",(function(){return W})),r.d(t,"getDateTypeTitle",(function(){return X})),r.d(t,"getShortcodePreview",(function(){return Z})),r.d(t,"ITEM_TOTAL_TYPES",(function(){return d})),r.d(t,"ITEM_META_TYPES",(function(){return b})),r.d(t,"ITEM_TABLE_BLOCK_TYPES",(function(){return p})),r.d(t,"DISCOUNT_TOTAL_TYPES",(function(){return g})),r.d(t,"FORMAT_TYPES",(function(){return y})),r.d(t,"setSetting",(function(){return w})),r.d(t,"getSetting",(function(){return s}))}});
