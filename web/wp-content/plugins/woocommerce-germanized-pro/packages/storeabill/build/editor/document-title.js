this.sab=this.sab||{},this.sab.blocks=this.sab.blocks||{},this.sab.blocks["document-title"]=function(t){function e(e){for(var n,i,a=e[0],l=e[1],u=e[2],f=0,d=[];f<a.length;f++)i=a[f],Object.prototype.hasOwnProperty.call(o,i)&&o[i]&&d.push(o[i][0]),o[i]=0;for(n in l)Object.prototype.hasOwnProperty.call(l,n)&&(t[n]=l[n]);for(s&&s(e);d.length;)d.shift()();return c.push.apply(c,u||[]),r()}function r(){for(var t,e=0;e<c.length;e++){for(var r=c[e],n=!0,a=1;a<r.length;a++){var l=r[a];0!==o[l]&&(n=!1)}n&&(c.splice(e--,1),t=i(i.s=r[0]))}return t}var n={},o={11:0,40:0},c=[];function i(e){if(n[e])return n[e].exports;var r=n[e]={i:e,l:!1,exports:{}};return t[e].call(r.exports,r,r.exports,i),r.l=!0,r.exports}i.m=t,i.c=n,i.d=function(t,e,r){i.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:r})},i.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},i.t=function(t,e){if(1&e&&(t=i(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var r=Object.create(null);if(i.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var n in t)i.d(r,n,function(e){return t[e]}.bind(null,n));return r},i.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return i.d(e,"a",e),e},i.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},i.p="";var a=window.webpackStoreaBillJsonp=window.webpackStoreaBillJsonp||[],l=a.push.bind(a);a.push=e,a=a.slice();for(var u=0;u<a.length;u++)e(a[u]);var s=l;return c.push([91,1,0]),r()}({0:function(t,e){t.exports=window.wp.element},1:function(t,e){t.exports=window.wp.components},10:function(t,e){t.exports=window.wp.primitives},11:function(t,e){t.exports=window.wp.apiFetch},12:function(t,e){t.exports=window.wp.url},15:function(t,e){t.exports=window.wp.blocks},19:function(t,e){t.exports=window.wp.compose},2:function(t,e){t.exports=window.lodash},3:function(t,e){t.exports=window.wp.blockEditor},4:function(t,e){t.exports=window.wp.i18n},6:function(t,e){t.exports=window.wp.data},67:function(t,e,r){},7:function(t,e,r){"use strict";var n=r(2),o=r(3),c=r(18),i=r.n(c),a=r(17),l=r.n(a),u=r(5),s=r.n(u),f=r(0),d=r(20),p=r.n(d),b=r(9),m=r.n(b),g=r(4),y=r(6),O=r(13),v=r.n(O),h=r(16),j=r.n(h),w=["backgroundColor","textColor"],T=function(t,e,r){return"function"==typeof t?t(e):!0===t?r:t};function C(t){var e=t.title,r=t.colorSettings,c=t.colorPanelProps,i=t.contrastCheckers,a=t.detectedBackgroundColor,l=t.detectedColor,u=t.panelChildren,s=t.initialOpen;return Object(f.createElement)(o.PanelColorSettings,v()({title:e,initialOpen:s,colorSettings:Object.values(r)},c),i&&(Array.isArray(i)?i.map((function(t){var e=t.backgroundColor,n=t.textColor,c=j()(t,w);return e=T(e,r,a),n=T(n,r,l),Object(f.createElement)(o.ContrastChecker,v()({key:"".concat(e,"-").concat(n),backgroundColor:e,textColor:n},c))})):Object(n.map)(r,(function(t){var e=t.value,n=i.backgroundColor,c=i.textColor;return n=T(n||e,r,a),c=T(c||e,r,l),Object(f.createElement)(o.ContrastChecker,v()({},i,{key:"".concat(n,"-").concat(c),backgroundColor:n,textColor:c}))}))),"function"==typeof u?u(r):u)}function S(t,e){var r="undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(!r){if(Array.isArray(t)||(r=function(t,e){if(!t)return;if("string"==typeof t)return P(t,e);var r=Object.prototype.toString.call(t).slice(8,-1);"Object"===r&&t.constructor&&(r=t.constructor.name);if("Map"===r||"Set"===r)return Array.from(t);if("Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r))return P(t,e)}(t))||e&&t&&"number"==typeof t.length){r&&(t=r);var n=0,o=function(){};return{s:o,n:function(){return n>=t.length?{done:!0}:{done:!1,value:t[n++]}},e:function(t){throw t},f:o}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var c,i=!0,a=!1;return{s:function(){r=r.call(t)},n:function(){var t=r.next();return i=t.done,t},e:function(t){a=!0,c=t},f:function(){try{i||null==r.return||r.return()}finally{if(a)throw c}}}}function P(t,e){(null==e||e>t.length)&&(e=t.length);for(var r=0,n=new Array(e);r<e;r++)n[r]=t[r];return n}function _(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,n)}return r}function x(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?_(Object(r),!0).forEach((function(e){s()(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):_(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}function k(t){return t.ownerDocument.defaultView.getComputedStyle(t)}var E=[],N={textColor:Object(g.__)("Text color"),backgroundColor:Object(g.__)("Background color")},F=function(t){return Object(f.createElement)(o.InspectorControls,null,Object(f.createElement)(C,t))};r.d(e,"g",(function(){return D})),r.d(e,"b",(function(){return A})),r.d(e,"a",(function(){return B})),r.d(e,"c",(function(){return M})),r.d(e,"e",(function(){return I})),r.d(e,"d",(function(){return z})),r.d(e,"f",(function(){return L}));var D=void 0===o.__experimentalUseColors?function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{panelTitle:Object(g.__)("Color")},r=e.panelTitle,c=void 0===r?Object(g.__)("Color"):r,a=e.colorPanelProps,u=e.contrastCheckers,d=e.panelChildren,b=e.colorDetector,O=void 0===b?{}:b,v=O.targetRef,h=O.backgroundColorTargetRef,j=void 0===h?v:h,w=O.textColorTargetRef,T=void 0===w?v:w,P=arguments.length>2&&void 0!==arguments[2]?arguments[2]:[],_=Object(o.useBlockEditContext)(),D=_.clientId,A=Object(o.useSetting)("color.palette")||E,B=Object(y.useSelect)((function(t){return{attributes:(0,t(o.store).getBlockAttributes)(D)}}),[D]),M=B.attributes,I=Object(y.useDispatch)(o.store),z=I.updateBlockAttributes,L=Object(f.useCallback)((function(t){return z(D,t)}),[z,D]),R=Object(f.useMemo)((function(){return p()((function(t,e,r,o,c,i){return function(a){var l,u=a.children,d=a.className,p=void 0===d?"":d,b=a.style,g=void 0===b?{}:b,y={};o?y=s()({},e,c):i&&(y=s()({},e,i));var O={className:m()(p,(l={},s()(l,"has-".concat(Object(n.kebabCase)(o),"-").concat(Object(n.kebabCase)(e)),o),s()(l,r||"has-".concat(Object(n.kebabCase)(t)),o||i),l)),style:x(x({},y),g)};return Object(n.isFunction)(u)?u(O):f.Children.map(u,(function(t){return Object(f.cloneElement)(t,{className:m()(t.props.className,O.className),style:x(x({},O.style),t.props.style||{})})}))}}),{maxSize:t.length})}),[t.length]),Y=Object(f.useMemo)((function(){return p()((function(t,e){return function(r){var o=e.find((function(t){return t.color===r}));L(s()({},o?Object(n.camelCase)("custom ".concat(t)):t,void 0)),L(s()({},o?t:Object(n.camelCase)("custom ".concat(t)),o?o.slug:r))}}),{maxSize:t.length})}),[L,t.length]),H=Object(f.useState)(),U=l()(H,2),$=U[0],q=U[1],J=Object(f.useState)(),K=l()(J,2),Q=K[0],V=K[1];return Object(f.useEffect)((function(){if(u){var t,e=!1,r=!1,o=S(Object(n.castArray)(u));try{for(o.s();!(t=o.n()).done;){var c=t.value,i=c.backgroundColor,a=c.textColor;if(e||(e=!0===i),r||(r=!0===a),e&&r)break}}catch(t){o.e(t)}finally{o.f()}if(r&&V(k(T.current).color),e){for(var l=j.current,s=k(l).backgroundColor;"rgba(0, 0, 0, 0)"===s&&l.parentNode&&l.parentNode.nodeType===l.parentNode.ELEMENT_NODE;)s=k(l=l.parentNode).backgroundColor;q(s)}}}),[t.reduce((function(t,e){return"".concat(t," | ").concat(M[e.name]," | ").concat(M[Object(n.camelCase)("custom ".concat(e.name))])}),"")].concat(i()(P))),Object(f.useMemo)((function(){var e={},r=t.reduce((function(t,r){"string"==typeof r&&(r={name:r});var o=x(x({},r),{},{color:M[r.name]}),c=o.name,i=o.property,a=void 0===i?c:i,l=o.className,u=o.panelLabel,s=void 0===u?r.label||N[c]||Object(n.startCase)(c):u,f=o.componentName,d=void 0===f?Object(n.startCase)(c).replace(/\s/g,""):f,p=o.color,b=void 0===p?r.color:p,m=o.colors,g=void 0===m?A:m,y=M[Object(n.camelCase)("custom ".concat(c))],O=y?void 0:g.find((function(t){return t.slug===b}));return t[d]=R(c,a,l,b,O&&O.color,y),t[d].displayName=d,t[d].color=y||O&&O.color,t[d].slug=b,t[d].setColor=Y(c,g),e[d]={value:O?O.color:M[Object(n.camelCase)("custom ".concat(c))],onChange:t[d].setColor,label:s,colors:g},g||delete e[d].colors,t}),{}),o={title:c,initialOpen:!1,colorSettings:e,colorPanelProps:a,contrastCheckers:u,detectedBackgroundColor:$,detectedColor:Q,panelChildren:d};return x(x({},r),{},{ColorPanel:Object(f.createElement)(C,o),InspectorControlsColorPanel:Object(f.createElement)(F,o)})}),[M,L,Q,$].concat(i()(P)))}:o.__experimentalUseColors;function A(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"";return'<span class="placeholder-content '+(Object(n.isEmpty)(e)?"":"sab-tooltip")+'" contenteditable="false" '+(Object(n.isEmpty)(e)?"":'data-tooltip="'+e+'"')+'><span class="editor-placeholder"></span>'+t+"</span>"}function B(t){return"string"==typeof t&&/^\d+$/.test(t)&&(t=parseInt(t)),t}function M(t){var e,r=t;return t&&t.hasOwnProperty("size")&&(r=t.size),r?(e=r,isNaN(parseFloat(e))||isNaN(e-0)?r:r+"px"):void 0}function I(t,e,r,o){var c=arguments.length>4&&void 0!==arguments[4]?arguments[4]:"";return t&&Object(n.includes)(t,r)||(t=Object(n.includes)(t,"{default}")?t.replace("{default}",o||A(r,c)):o||A(r,c)),t.replace(r,e)}function z(t,e,r){return t.replace(r,e)}function L(t,e){var r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"placeholder-content",n=arguments.length>3&&void 0!==arguments[3]&&arguments[3],o=(new DOMParser).parseFromString(t,"text/html"),c=!1;if((c=n?o.querySelectorAll("[data-shortcode='"+r+"']"):o.getElementsByClassName(r)).length>0){var i=c[0].getElementsByClassName("editor-placeholder");if(i.length>0){for(var a=i[0].nextSibling,l=[];a;)a!==i[0]&&l.push(a),a=a.nextSibling;l.forEach((function(t){i[0].parentNode.removeChild(t)})),i[0].insertAdjacentHTML("afterEnd",e)}else c[0].innerHTML='<span class="editor-placeholder"></span>'+e;c[0].classList.remove("document-shortcode-needs-refresh"),t=o.body.innerHTML}return t}},8:function(t,e,r){"use strict";r.r(e);var n=r(5),o=r.n(n),c=r(21);function i(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,n)}return r}function a(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?i(Object(r),!0).forEach((function(e){o()(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):i(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}var l="object"===("undefined"==typeof sabSettings?"undefined":r.n(c)()(sabSettings))?sabSettings:{},u=a(a({},{itemTotalTypes:[],itemMetaTypes:[],itemTableBlockTypes:[],discountTotalTypes:{}}),l);function s(t){var e=arguments.length>1&&void 0!==arguments[1]&&arguments[1],r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:function(t){return t},n=u.hasOwnProperty(t)?u[t]:e;return r(n,e)}var f=r(4),d=u.itemTotalTypes,p=u.itemMetaTypes,b=u.itemTableBlockTypes,m=u.discountTotalTypes,g=["core/bold","core/italic","core/text-color","core/underline","storeabill/document-shortcode","storeabill/font-size"],y=r(6),O=r(2),v=r(11),h=r.n(v),j=r(12);r(1);function w(t,e){var r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:function(t){return t};u[t]=r(e)}function T(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"";return t=""===t?s("mainLineItemType"):t,p.hasOwnProperty(t)?p[t]:[]}function C(t,e){Array.isArray(e)||(e=[e]);var r=Object(y.select)("core/block-editor").getBlockParents(t);if(r.length>0){var n=Object(y.select)("core/block-editor").getBlock(r[0]);if(Object(O.includes)(e,n.name))return!0}return!1}function S(t){var e=s("supports");return Object(O.includes)(e,t)}function P(t){var e=s("defaultInnerBlocks");return e.hasOwnProperty(t)?e[t]:[]}function _(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"product",r=T(e),n=r.filter((function(e){if(t===e.type)return!0})),o=n.length>0?n[0].preview:"",c=k(e),i=c.meta_data.filter((function(e){if(t===e.key)return!0}));return i.length>0?i[0].value:o}function x(){return s("preview",{})}function k(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"";t=""===t?s("mainLineItemType"):t;var e=x();return e[t+"_items"][0]}function E(t){var e=d.filter((function(e){if(t===e.type)return!0}));return e&&e[0]?e[0].default:""}function N(t){var e=d.filter((function(e){if(t===e.type)return!0}));return e&&e[0]?e[0].title:""}function F(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"total",e=!(arguments.length>1&&void 0!==arguments[1])||arguments[1],r=x(),n=r.totals,o=n.filter((function(e){return e.type===t}));return o.length>0?e?o[0].total_formatted:o[0].total:0}function D(){var t=x().tax_items;return t.length>0?t[0].rate.percent:"{rate}"}function A(){return x().formatted_discount_notice}function B(){var t=x().voucher_items;return t.length>0?t[0].code:"{code}"}function M(){var t=x().fee_items;return t.length>0?t[0].name:"{name}"}function I(t,e){var r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"read",n={top:t.top?t.top:e.top,left:t.left?t.left:e.left,right:t.right?t.right:e.right,bottom:t.bottom?t.bottom:e.bottom};if("edit"===r){var o=s("marginTypesSupported"),c={};return o.forEach((function(t){c[t]=n[t]})),c}return n}function z(){return"document_template"===Object(y.select)("core/editor").getCurrentPostType()}function L(){return s("allowedBlockTypes")}function R(){var t=void 0,e=(0,Object(y.select)("core/block-editor").getBlocks)().filter((function(t){if("storeabill/document-styles"===t.name)return t}));return e.length>0&&(t=e[0]),t}function Y(){return s("fonts")}function H(t){var e=Y().filter((function(e){if(e.name===t)return!0}));if(!Object(O.isEmpty)(e))return e[0]}function U(){var t=(0,Object(y.select)("core/editor").getEditedPostAttribute)("meta");return t._fonts?t._fonts:void 0}function $(t){t=t||U();var e=Object(j.addQueryArgs)("/sab/v1/preview_fonts/css",{fonts:t,display_types:s("fontDisplayTypes")});return h()({path:e})}function q(t){var e=!(arguments.length>1&&void 0!==arguments[1])||arguments[1],r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"",n=t;return"before_discounts"===r&&(n+="_subtotal",Object(O.includes)(t,"total")&&(n=t.replace("total","")),"total"===t?n="subtotal":"total_tax"===t&&(n="subtotal_tax")),!1!==e||Object(O.includes)(t,"_tax")||(Object(O.includes)(t,"_total")&&(n=n.replace("_total","")),n+="_net"),n+"_formatted"}function J(t){var e="";return"document"===t?e=Object(f._x)("Document","storeabill-core","woocommerce-germanized-pro"):"document_item"===t?e=Object(f._x)("Document Item","storeabill-core","woocommerce-germanized-pro"):"document_total"===t?e=Object(f._x)("Document Total","storeabill-core","woocommerce-germanized-pro"):"setting"===t&&(e=Object(f._x)("Settings","storeabill-core","woocommerce-germanized-pro")),e}function K(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"",e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"",r=arguments.length>2&&void 0!==arguments[2]&&arguments[2],n=s("shortcodes"),o=Object.entries(n),c=["blocks","setting","document"],i={};o.forEach((function(n,o){var a=n[0];if((!(t.length>0&&t!==a)||Object(O.includes)(c,a))&&("blocks"!==a||0!==e.length)){var l=[],u=J(a);if(Object(O.isArray)(n[1]))l=n[1].flat();else if(e.length>0){l=n[1].hasOwnProperty(e)?n[1][e]:[];var s=Object(y.select)("core/blocks").getBlockType(e);u=s?s.title:e}i.hasOwnProperty(a)||(i[a]={label:u,value:a,children:{}}),l.map((function(t){if(!i[a].children.hasOwnProperty(t.shortcode)){if(!r&&t.hasOwnProperty("headerFooterOnly")&&t.headerFooterOnly)return;i[a].children[t.shortcode]={value:t.shortcode,label:t.title}}}))}}));var a=[];return Object.entries(i).map((function(t){var e=Object.values(t[1].children).flat();Object(O.isEmpty)(e)||a.push({value:t[1].value,label:t[1].label,children:e})})),a}function Q(t){var e=s("shortcodes"),r=Object.entries(e),n={};return r.forEach((function(t,e){(Object(O.isArray)(t[1])?t[1].flat():Object.values(t[1]).flat()).map((function(t){n.hasOwnProperty(t.shortcode)||(n[t.shortcode]=t)}))})),!!n.hasOwnProperty(t)&&n[t]}function V(t){var e=Q(t);return e?e.title:""}function G(){return s("dateTypes")}function W(){return s("barcodeTypes")}function X(){return s("barcodeCodeTypes")}function Z(t){var e=s("dateTypes"),r=Object(f._x)("Date","storeabill-core","woocommerce-germanized-pro");return Object.entries(e).map((function(e){e[0]===t&&(r=e[1])})),r}function tt(t){try{t=parseFloat(t),"invoice_cancellation"===s("documentType")&&(t*=-1);var e=s("priceFormat").decimals,r=s("priceFormat").decimal_separator,n=s("priceFormat").thousand_separator,o=s("priceFormat").currency,c=s("priceFormat").format;e=Math.abs(e),e=isNaN(e)?2:e;var i=t<0?"-":"",a=parseInt(t=Math.abs(Number(t)||0).toFixed(e)).toString(),l=a.length>3?a.length%3:0,u=i+(l?a.substr(0,l)+n:"")+a.substr(l).replace(/(\d{3})(?=\d)/g,"$1"+n)+(e?r+Math.abs(t-a).toFixed(e).slice(2):"");return c.replace("%s",o).replace("%v",u)}catch(e){return t}}function et(t){var e=Object(j.addQueryArgs)("/sab/v1/preview_shortcodes",{query:t,document_type:s("documentType")});return h()({path:e})}r.d(e,"getItemMetaTypes",(function(){return T})),r.d(e,"blockHasParent",(function(){return C})),r.d(e,"documentTypeSupports",(function(){return S})),r.d(e,"getDefaultInnerBlocks",(function(){return P})),r.d(e,"getItemMetaTypePreview",(function(){return _})),r.d(e,"getPreview",(function(){return x})),r.d(e,"getPreviewItem",(function(){return k})),r.d(e,"getItemTotalTypeDefaultTitle",(function(){return E})),r.d(e,"getItemTotalTypeTitle",(function(){return N})),r.d(e,"getPreviewTotal",(function(){return F})),r.d(e,"getPreviewTaxRate",(function(){return D})),r.d(e,"getPreviewDiscountNotice",(function(){return A})),r.d(e,"getPreviewVoucherNotice",(function(){return B})),r.d(e,"getPreviewFeeName",(function(){return M})),r.d(e,"formatMargins",(function(){return I})),r.d(e,"isDocumentTemplate",(function(){return z})),r.d(e,"getAllowedBlockTypes",(function(){return L})),r.d(e,"getDocumentStylesBlock",(function(){return R})),r.d(e,"getFonts",(function(){return Y})),r.d(e,"getFont",(function(){return H})),r.d(e,"getCurrentFonts",(function(){return U})),r.d(e,"getFontsCSS",(function(){return $})),r.d(e,"getItemTotalKey",(function(){return q})),r.d(e,"getShortcodeCategoryTitle",(function(){return J})),r.d(e,"getAvailableShortcodeTree",(function(){return K})),r.d(e,"getShortcodeData",(function(){return Q})),r.d(e,"getShortcodeTitle",(function(){return V})),r.d(e,"getDateTypes",(function(){return G})),r.d(e,"getBarcodeTypes",(function(){return W})),r.d(e,"getBarcodeCodeTypes",(function(){return X})),r.d(e,"getDateTypeTitle",(function(){return Z})),r.d(e,"formatPrice",(function(){return tt})),r.d(e,"getShortcodePreview",(function(){return et})),r.d(e,"ITEM_TOTAL_TYPES",(function(){return d})),r.d(e,"ITEM_META_TYPES",(function(){return p})),r.d(e,"ITEM_TABLE_BLOCK_TYPES",(function(){return b})),r.d(e,"DISCOUNT_TOTAL_TYPES",(function(){return m})),r.d(e,"FORMAT_TYPES",(function(){return g})),r.d(e,"setSetting",(function(){return w})),r.d(e,"getSetting",(function(){return s}))},91:function(t,e,r){"use strict";r.r(e);var n=r(5),o=r.n(n),c=r(4),i=r(15),a=r(116),l=r(0),u=r(9),s=r.n(u),f=r(3),d=r(1),p=r(19),b=r(8),m=r(7);var g=Object(p.compose)([Object(f.withFontSizes)("fontSize")])((function(t){var e,r=t.attributes,n=t.setAttributes,i=t.fontSize,a=t.setFontSize,u=t.className,p=r.title,g=r.align,y=Object(b.getPreview)().formatted_number,O=s()("document-title placeholder-wrapper",u,(e={},o()(e,"has-text-align-".concat(g),g),o()(e,i.class,i.class),e)),v=(Object(l.useRef)(),Object(b.getSetting)("documentTypeTitle")+' <span class="document-shortcode sab-tooltip" contenteditable="false" data-tooltip="'+Object(c._x)("Formatted document number","storeabill-core","woocommerce-germanized-pro")+'" data-shortcode="document?data=formatted_number"><span class="editor-placeholder"></span>'+y+"</span>"),h=Object(m.g)([{name:"textColor",property:"color"}],[i.size]),j=h.TextColor,w=h.InspectorControlsColorPanel;return Object(l.createElement)(l.Fragment,null,Object(l.createElement)(f.BlockControls,null,Object(l.createElement)(f.AlignmentToolbar,{value:g,onChange:function(t){return n({align:t})}})),Object(l.createElement)(f.InspectorControls,null,Object(l.createElement)(d.PanelBody,{title:Object(c._x)("Typography","storeabill-core","woocommerce-germanized-pro")},Object(l.createElement)(f.FontSizePicker,{value:Object(m.a)(i.size),onChange:a}))),w,Object(l.createElement)(j,null,Object(l.createElement)(f.RichText,{tagName:"p",value:p||v,placeholder:"",className:O,onChange:function(t){return n({title:t})},allowedFormats:b.FORMAT_TYPES,style:{fontSize:Object(m.c)(i)}})))}));function y(t){var e,r=t.attributes,n=r.title,c=r.align,i=r.textColor,a=r.customTextColor,u=r.fontSize,d=r.customFontSize,p=Object(f.getColorClassName)("color",i),b=Object(f.getFontSizeClass)(u),g=s()((e={"has-text-color":i||a},o()(e,"has-text-align-".concat(c),c),o()(e,b,b),o()(e,p,p),e)),y={color:p?void 0:a,fontSize:b?void 0:Object(m.c)(d)};return Object(l.createElement)(f.RichText.Content,{tagName:"p",className:g,value:n,style:y})}r(67);function O(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,n)}return r}function v(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?O(Object(r),!0).forEach((function(e){o()(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):O(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}var h={title:Object(c._x)("Document Title","storeabill-core","woocommerce-germanized-pro"),description:Object(c._x)("Inserts the document title.","storeabill-core","woocommerce-germanized-pro"),category:"storeabill",icon:a.a,example:{},supports:{html:!1,className:!1},attributes:{title:{type:"string",source:"html",selector:"p"},align:{type:"string",default:"left"},textColor:{type:"string"},customTextColor:{type:"string"},fontSize:{type:"string"},customFontSize:{type:"string"}},edit:g,save:y,deprecated:[{supports:{html:!1,className:!1},attributes:{title:{type:"string",source:"html",selector:"p"},align:{type:"string",default:"left"},textColor:{type:"string"},customTextColor:{type:"string"},fontSize:{type:"string"},customFontSize:{type:"number"}},isEligible:function(t){return"number"==typeof t.customFontSize},migrate:function(t){return v(v({},t),{},{customFontSize:t.customFontSize?""+t.customFontSize:void 0})},save:function(t){return y(t)}}]};Object(i.registerBlockType)("storeabill/document-title",h)}});