this.sab=this.sab||{},this.sab.blocks=this.sab.blocks||{},this.sab.blocks.settings=function(t){function e(e){for(var r,u,c=e[0],a=e[1],l=e[2],f=0,d=[];f<c.length;f++)u=c[f],Object.prototype.hasOwnProperty.call(o,u)&&o[u]&&d.push(o[u][0]),o[u]=0;for(r in a)Object.prototype.hasOwnProperty.call(a,r)&&(t[r]=a[r]);for(s&&s(e);d.length;)d.shift()();return i.push.apply(i,l||[]),n()}function n(){for(var t,e=0;e<i.length;e++){for(var n=i[e],r=!0,c=1;c<n.length;c++){var a=n[c];0!==o[a]&&(r=!1)}r&&(i.splice(e--,1),t=u(u.s=n[0]))}return t}var r={},o={38:0},i=[];function u(e){if(r[e])return r[e].exports;var n=r[e]={i:e,l:!1,exports:{}};return t[e].call(n.exports,n,n.exports,u),n.l=!0,n.exports}u.m=t,u.c=r,u.d=function(t,e,n){u.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:n})},u.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},u.t=function(t,e){if(1&e&&(t=u(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var n=Object.create(null);if(u.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var r in t)u.d(n,r,function(e){return t[e]}.bind(null,r));return n},u.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return u.d(e,"a",e),e},u.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},u.p="";var c=window.webpackStoreaBillJsonp=window.webpackStoreaBillJsonp||[],a=c.push.bind(c);c.push=e,c=c.slice();for(var l=0;l<c.length;l++)e(c[l]);var s=a;return i.push([9,0]),n()}([,function(t,e){t.exports=window.lodash},,function(t,e){t.exports=window.wp.i18n},,,function(t,e){t.exports=window.wp.data},,function(t,e){t.exports=window.wp.components},function(t,e,n){"use strict";n.r(e);var r=n(4),o=n.n(r),i=n(22);function u(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,r)}return n}function c(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?u(Object(n),!0).forEach((function(e){o()(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):u(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}var a="object"===("undefined"==typeof sabSettings?"undefined":n.n(i)()(sabSettings))?sabSettings:{},l=c(c({},{itemTotalTypes:[],itemMetaTypes:[],itemTableBlockTypes:[],discountTotalTypes:{}}),a);function s(t){var e=arguments.length>1&&void 0!==arguments[1]&&arguments[1],n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:function(t){return t},r=l.hasOwnProperty(t)?l[t]:e;return n(r,e)}var f=n(3),d=l.itemTotalTypes,p=l.itemMetaTypes,b=l.itemTableBlockTypes,g=l.discountTotalTypes,v=["core/bold","core/italic","core/text-color","core/underline","storeabill/document-shortcode","storeabill/font-size"],y=n(6),h=n(1),O=n(12),m=n.n(O),T=n(13);n(8);function w(t,e){var n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:function(t){return t};l[t]=n(e)}function j(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"product";return p.hasOwnProperty(t)?p[t]:[]}function _(t,e){Array.isArray(e)||(e=[e]);var n=Object(y.select)("core/block-editor").getBlockParents(t);if(n.length>0){var r=Object(y.select)("core/block-editor").getBlock(n[0]);if(Object(h.includes)(e,r.name))return!0}return!1}function P(t){var e=s("supports");return Object(h.includes)(e,t)}function S(t){var e=s("defaultInnerBlocks");return e.hasOwnProperty(t)?e[t]:[]}function k(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"product",n=j(e),r=n.filter((function(e){if(t===e.type)return!0})),o=r.length>0?r[0].preview:"",i=D(e),u=i.meta_data.filter((function(e){if(t===e.key)return!0}));return u.length>0?u[0].value:o}function x(){return s("preview",{})}function D(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"product",e=x();return e[t+"_items"][0]}function E(t){var e=d.filter((function(e){if(t===e.type)return!0}));return e&&e[0]?e[0].default:""}function B(t){var e=d.filter((function(e){if(t===e.type)return!0}));return e&&e[0]?e[0].title:""}function A(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"total",e=x(),n=e.totals,r=n.filter((function(e){return e.type===t}));return r.length>0?r[0].total_formatted:0}function M(){var t=x().tax_items;return t.length>0?t[0].rate.percent:"{rate}"}function I(){return x().formatted_discount_notice}function F(){var t=x().fee_items;return t.length>0?t[0].name:"{name}"}function C(t,e){var n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"read",r={top:t.top?t.top:e.top,left:t.left?t.left:e.left,right:t.right?t.right:e.right,bottom:t.bottom?t.bottom:e.bottom};if("edit"===n){var o=s("marginTypesSupported"),i={};return o.forEach((function(t){i[t]=r[t]})),i}return r}function Y(){return"document_template"===Object(y.select)("core/editor").getCurrentPostType()}function L(){return s("allowedBlockTypes")}function N(){var t=void 0,e=(0,Object(y.select)("core/block-editor").getBlocks)().filter((function(t){if("storeabill/document-styles"===t.name)return t}));return e.length>0&&(t=e[0]),t}function J(){return s("fonts")}function K(t){var e=J().filter((function(e){if(e.name===t)return!0}));if(!Object(h.isEmpty)(e))return e[0]}function Q(){var t=(0,Object(y.select)("core/editor").getEditedPostAttribute)("meta");return t._fonts?t._fonts:void 0}function R(t){t=t||Q();var e=Object(T.addQueryArgs)("/sab/v1/preview_fonts/css",{fonts:t,display_types:s("fontDisplayTypes")});return m()({path:e})}function q(t){var e=!(arguments.length>1&&void 0!==arguments[1])||arguments[1],n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"",r=t;return"before_discounts"===n&&(r+="_subtotal",Object(h.includes)(t,"total")&&(r=t.replace("total","")),"total"===t&&(r="subtotal")),!1===e&&(Object(h.includes)(t,"_total")&&(r=r.replace("_total","")),r+="_net"),r+"_formatted"}function z(t){var e="";return"document"===t?e=Object(f._x)("Document","storeabill-core","woocommerce-germanized-pro"):"document_item"===t?e=Object(f._x)("Document Item","storeabill-core","woocommerce-germanized-pro"):"document_total"===t?e=Object(f._x)("Document Total","storeabill-core","woocommerce-germanized-pro"):"setting"===t&&(e=Object(f._x)("Settings","storeabill-core","woocommerce-germanized-pro")),e}function H(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"",e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"",n=arguments.length>2&&void 0!==arguments[2]&&arguments[2],r=s("shortcodes"),o=Object.entries(r),i=["blocks","setting"],u={};o.forEach((function(r,o){var c=r[0];if((!(t.length>0&&t!==c)||Object(h.includes)(i,c))&&("blocks"!==c||0!==e.length)){var a=[],l=z(c);if(Object(h.isArray)(r[1]))a=r[1].flat();else if(e.length>0){a=r[1].hasOwnProperty(e)?r[1][e]:[];var s=Object(y.select)("core/blocks").getBlockType(e);l=s?s.title:e}u.hasOwnProperty(c)||(u[c]={label:l,value:c,children:{}}),a.map((function(t){if(!u[c].children.hasOwnProperty(t.shortcode)){if(!n&&t.hasOwnProperty("headerFooterOnly")&&t.headerFooterOnly)return;u[c].children[t.shortcode]={value:t.shortcode,label:t.title}}}))}}));var c=[];return Object.entries(u).map((function(t){var e=Object.values(t[1].children).flat();Object(h.isEmpty)(e)||c.push({value:t[1].value,label:t[1].label,children:e})})),c}function U(t){var e=s("shortcodes"),n=Object.entries(e),r={};return n.forEach((function(t,e){(Object(h.isArray)(t[1])?t[1].flat():Object.values(t[1]).flat()).map((function(t){r.hasOwnProperty(t.shortcode)||(r[t.shortcode]=t)}))})),!!r.hasOwnProperty(t)&&r[t]}function G(t){var e=U(t);return e?e.title:""}function V(){return s("dateTypes")}function W(){return s("barcodeTypes")}function X(){return s("barcodeCodeTypes")}function Z(t){var e=s("dateTypes"),n=Object(f._x)("Date","storeabill-core","woocommerce-germanized-pro");return Object.entries(e).map((function(e){e[0]===t&&(n=e[1])})),n}function $(t){var e=Object(T.addQueryArgs)("/sab/v1/preview_shortcodes",{query:t,document_type:s("documentType")});return m()({path:e})}n.d(e,"getItemMetaTypes",(function(){return j})),n.d(e,"blockHasParent",(function(){return _})),n.d(e,"documentTypeSupports",(function(){return P})),n.d(e,"getDefaultInnerBlocks",(function(){return S})),n.d(e,"getItemMetaTypePreview",(function(){return k})),n.d(e,"getPreview",(function(){return x})),n.d(e,"getPreviewItem",(function(){return D})),n.d(e,"getItemTotalTypeDefaultTitle",(function(){return E})),n.d(e,"getItemTotalTypeTitle",(function(){return B})),n.d(e,"getPreviewTotal",(function(){return A})),n.d(e,"getPreviewTaxRate",(function(){return M})),n.d(e,"getPreviewDiscountNotice",(function(){return I})),n.d(e,"getPreviewFeeName",(function(){return F})),n.d(e,"formatMargins",(function(){return C})),n.d(e,"isDocumentTemplate",(function(){return Y})),n.d(e,"getAllowedBlockTypes",(function(){return L})),n.d(e,"getDocumentStylesBlock",(function(){return N})),n.d(e,"getFonts",(function(){return J})),n.d(e,"getFont",(function(){return K})),n.d(e,"getCurrentFonts",(function(){return Q})),n.d(e,"getFontsCSS",(function(){return R})),n.d(e,"getItemTotalKey",(function(){return q})),n.d(e,"getShortcodeCategoryTitle",(function(){return z})),n.d(e,"getAvailableShortcodeTree",(function(){return H})),n.d(e,"getShortcodeData",(function(){return U})),n.d(e,"getShortcodeTitle",(function(){return G})),n.d(e,"getDateTypes",(function(){return V})),n.d(e,"getBarcodeTypes",(function(){return W})),n.d(e,"getBarcodeCodeTypes",(function(){return X})),n.d(e,"getDateTypeTitle",(function(){return Z})),n.d(e,"getShortcodePreview",(function(){return $})),n.d(e,"ITEM_TOTAL_TYPES",(function(){return d})),n.d(e,"ITEM_META_TYPES",(function(){return p})),n.d(e,"ITEM_TABLE_BLOCK_TYPES",(function(){return b})),n.d(e,"DISCOUNT_TOTAL_TYPES",(function(){return g})),n.d(e,"FORMAT_TYPES",(function(){return v})),n.d(e,"setSetting",(function(){return w})),n.d(e,"getSetting",(function(){return s}))},,,function(t,e){t.exports=window.wp.apiFetch},function(t,e){t.exports=window.wp.url}]);