this.sab=this.sab||{},this.sab.blocks=this.sab.blocks||{},this.sab.blocks["item-table-column"]=function(e){function t(t){for(var r,c,l=t[0],a=t[1],u=t[2],d=0,f=[];d<l.length;d++)c=l[d],Object.prototype.hasOwnProperty.call(o,c)&&o[c]&&f.push(o[c][0]),o[c]=0;for(r in a)Object.prototype.hasOwnProperty.call(a,r)&&(e[r]=a[r]);for(s&&s(t);f.length;)f.shift()();return i.push.apply(i,u||[]),n()}function n(){for(var e,t=0;t<i.length;t++){for(var n=i[t],r=!0,l=1;l<n.length;l++){var a=n[l];0!==o[a]&&(r=!1)}r&&(i.splice(t--,1),e=c(c.s=n[0]))}return e}var r={},o={31:0,40:0},i=[];function c(t){if(r[t])return r[t].exports;var n=r[t]={i:t,l:!1,exports:{}};return e[t].call(n.exports,n,n.exports,c),n.l=!0,n.exports}c.m=e,c.c=r,c.d=function(e,t,n){c.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},c.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},c.t=function(e,t){if(1&t&&(e=c(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(c.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)c.d(n,r,function(t){return e[t]}.bind(null,r));return n},c.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return c.d(t,"a",t),t},c.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},c.p="";var l=window.webpackStoreaBillJsonp=window.webpackStoreaBillJsonp||[],a=l.push.bind(l);l.push=t,l=l.slice();for(var u=0;u<l.length;u++)t(l[u]);var s=a;return i.push([78,0]),n()}({0:function(e,t){e.exports=window.wp.element},1:function(e,t){e.exports=window.wp.components},11:function(e,t){e.exports=window.wp.apiFetch},12:function(e,t){e.exports=window.wp.url},15:function(e,t){e.exports=window.wp.blocks},19:function(e,t){e.exports=window.wp.compose},2:function(e,t){e.exports=window.lodash},3:function(e,t){e.exports=window.wp.blockEditor},37:function(e,t){e.exports=window.wp.hooks},4:function(e,t){e.exports=window.wp.i18n},6:function(e,t){e.exports=window.wp.data},78:function(e,t,n){"use strict";n.r(t);var r=n(15),o=n(4),i=n(0),c=n(19),l=n(2),a=n(37),u=n(6),s=n(5),d=n.n(s),f=n(9),p=n.n(f),b=n(3),g=n(1),m=n(8);var h=Object(c.compose)(Object(u.withSelect)((function(e,t){var n=t.clientId,r=e("core/block-editor"),o=r.getBlockOrder,i=r.getBlockRootClientId;(0,r.getBlockAttributes)(i(n));return{hasChildBlocks:o(n).length>0}})),Object(u.withDispatch)((function(e,t,n){return{updateAlignment:function(r){var o=t.clientId,i=t.setAttributes,c=e("core/block-editor").updateBlockAttributes,l=n.select("core/block-editor").getBlockRootClientId;i({verticalAlignment:r}),c(l(o),{verticalAlignment:null})}}})))((function(e){e.clientId;var t,n=e.attributes,r=e.setAttributes,c=e.className,l=e.hasChildBlocks,a=n.width,u=n.align,s=n.headingTextColor,f=n.headingBackgroundColor,h=n.headingFontSize,v=(n.itemType,n.isDisabled,n.fontSize),y=(n.customFontSize,p()(c,"block-core-columns",(t={},d()(t,"is-horizontally-aligned-".concat(u),u),d()(t,v?v.class:"",v?v.class:""),t)));return Object(i.createElement)("div",{className:y},Object(i.createElement)(b.BlockControls,null,Object(i.createElement)(b.AlignmentToolbar,{value:u,onChange:function(e){return r({align:e})}})),Object(i.createElement)(b.InspectorControls,null,Object(i.createElement)(g.PanelBody,{title:Object(o._x)("Column settings","storeabill-core","woocommerce-germanized-pro")},Object(i.createElement)(g.RangeControl,{label:Object(o._x)("Percentage width","storeabill-core","woocommerce-germanized-pro"),value:a||"",onChange:function(e){r({width:e})},min:0,max:100,step:.1,required:!0,allowReset:!0,placeholder:void 0===a?Object(o._x)("Auto","storeabill-core","woocommerce-germanized-pro"):void 0}))),Object(i.createElement)("div",{className:"item-column-heading",style:{backgroundColor:f}},Object(i.createElement)(b.RichText,{tagName:"span",className:"item-column-heading-text",placeholder:Object(o._x)("Write heading…","storeabill-core","woocommerce-germanized-pro"),value:n.heading,onChange:function(e){return r({heading:e})},allowedFormats:["core/bold","core/italic","core/text-color","core/underline","storeabill/document-shortcode"],style:{color:s,fontSize:h}})),Object(i.createElement)(b.InnerBlocks,{templateLock:!1,allowedBlocks:m.ITEM_TABLE_BLOCK_TYPES,renderAppender:l?void 0:function(){return Object(i.createElement)(b.InnerBlocks.ButtonBlockAppender,null)}}))}));function v(e){var t,n=e.attributes,r=n.width,o=n.heading,c=n.align,l=(n.headingBackgroundColor,n.headingTextColor,n.headingFontSize,p()("wp-block-storeabill-item-table-column",d()({},"is-horizontally-aligned-".concat(c),c)));return Number.isFinite(r)&&(t={flexBasis:r+"%"}),Object(i.createElement)("div",{className:l,style:t},Object(i.createElement)(b.RichText.Content,{tagName:"span",className:"item-column-heading-text",value:o}),Object(i.createElement)(b.InnerBlocks.Content,null))}var y=!1;Object(a.addFilter)("blocks.registerBlockType","storeabill/item-table-column",(function(e,t){if("core/column"!==t||y)return e;y=!0;var n=Object(l.cloneDeep)(e);return n.apiVersion=1,n.category="storeabill",n.name="storeabill/item-table-column",n.parent=["storeabill/item-table"],n.title=Object(o._x)("Column","storeabill-core","woocommerce-germanized-pro"),n.edit=h,n.save=v,n.supports.lightBlockWrapper=!1,n.supports.hasOwnProperty("__experimentalBorder")&&delete n.supports.__experimentalBorder,n.attributes={align:{type:"string",default:"left"},width:{type:"number"},isDisabled:{type:"boolean",default:!1},fontSize:{type:"string"},customFontSize:{type:"string"},itemType:{type:"string",default:""},headingTextColor:{type:"string"},headingFontSize:{type:"number"},headingBackgroundColor:{type:"string"},heading:{type:"string",default:Object(o._x)("Column Heading","storeabill-core","woocommerce-germanized-pro"),source:"html",selector:"span.item-column-heading-text"}},n.getEditWrapperProps=function(e){var t=e.width;return Number.isFinite(t)?{style:{flexBasis:t+"%"},"data-has-explicit-width":!0}:{}},Object(r.registerBlockType)("storeabill/item-table-column",n),e}))},8:function(e,t,n){"use strict";n.r(t);var r=n(5),o=n.n(r),i=n(21);function c(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function l(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?c(Object(n),!0).forEach((function(t){o()(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):c(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}var a="object"===("undefined"==typeof sabSettings?"undefined":n.n(i)()(sabSettings))?sabSettings:{},u=l(l({},{itemTotalTypes:[],itemMetaTypes:[],itemTableBlockTypes:[],discountTotalTypes:{}}),a);function s(e){var t=arguments.length>1&&void 0!==arguments[1]&&arguments[1],n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:function(e){return e},r=u.hasOwnProperty(e)?u[e]:t;return n(r,t)}var d=n(4),f=u.itemTotalTypes,p=u.itemMetaTypes,b=u.itemTableBlockTypes,g=u.discountTotalTypes,m=["core/bold","core/italic","core/text-color","core/underline","storeabill/document-shortcode","storeabill/font-size"],h=n(6),v=n(2),y=n(11),O=n.n(y),w=n(12);n(1);function T(e,t){var n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:function(e){return e};u[e]=n(t)}function j(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"";return e=""===e?s("mainLineItemType"):e,p.hasOwnProperty(e)?p[e]:[]}function _(e,t){Array.isArray(t)||(t=[t]);var n=Object(h.select)("core/block-editor").getBlockParents(e);if(n.length>0){var r=Object(h.select)("core/block-editor").getBlock(n[0]);if(Object(v.includes)(t,r.name))return!0}return!1}function k(e){var t=s("supports");return Object(v.includes)(t,e)}function x(e){var t=s("defaultInnerBlocks");return t.hasOwnProperty(e)?t[e]:[]}function P(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"product",n=j(t),r=n.filter((function(t){if(e===t.type)return!0})),o=r.length>0?r[0].preview:"",i=S(t),c=i.meta_data.filter((function(t){if(e===t.key)return!0}));return c.length>0?c[0].value:o}function B(){return s("preview",{})}function S(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"";e=""===e?s("mainLineItemType"):e;var t=B();return t[e+"_items"][0]}function E(e){var t=f.filter((function(t){if(e===t.type)return!0}));return t&&t[0]?t[0].default:""}function C(e){var t=f.filter((function(t){if(e===t.type)return!0}));return t&&t[0]?t[0].title:""}function A(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"total",t=!(arguments.length>1&&void 0!==arguments[1])||arguments[1],n=B(),r=n.totals,o=r.filter((function(t){return t.type===e}));return o.length>0?t?o[0].total_formatted:o[0].total:0}function F(){var e=B().tax_items;return e.length>0?e[0].rate.percent:"{rate}"}function I(){return B().formatted_discount_notice}function D(){var e=B().voucher_items;return e.length>0?e[0].code:"{code}"}function M(){var e=B().fee_items;return e.length>0?e[0].name:"{name}"}function N(e,t){var n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"read",r={top:e.top?e.top:t.top,left:e.left?e.left:t.left,right:e.right?e.right:t.right,bottom:e.bottom?e.bottom:t.bottom};if("edit"===n){var o=s("marginTypesSupported"),i={};return o.forEach((function(e){i[e]=r[e]})),i}return r}function z(){return"document_template"===Object(h.select)("core/editor").getCurrentPostType()}function L(){return s("allowedBlockTypes")}function R(){var e=void 0,t=(0,Object(h.select)("core/block-editor").getBlocks)().filter((function(e){if("storeabill/document-styles"===e.name)return e}));return t.length>0&&(e=t[0]),e}function Y(){return s("fonts")}function K(e){var t=Y().filter((function(t){if(t.name===e)return!0}));if(!Object(v.isEmpty)(t))return t[0]}function W(){var e=(0,Object(h.select)("core/editor").getEditedPostAttribute)("meta");return e._fonts?e._fonts:void 0}function q(e){e=e||W();var t=Object(w.addQueryArgs)("/sab/v1/preview_fonts/css",{fonts:e,display_types:s("fontDisplayTypes")});return O()({path:t})}function H(e){var t=!(arguments.length>1&&void 0!==arguments[1])||arguments[1],n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"",r=e;return"before_discounts"===n&&(r+="_subtotal",Object(v.includes)(e,"total")&&(r=e.replace("total","")),"total"===e?r="subtotal":"total_tax"===e&&(r="subtotal_tax")),!1!==t||Object(v.includes)(e,"_tax")||(Object(v.includes)(e,"_total")&&(r=r.replace("_total","")),r+="_net"),r+"_formatted"}function J(e){var t="";return"document"===e?t=Object(d._x)("Document","storeabill-core","woocommerce-germanized-pro"):"document_item"===e?t=Object(d._x)("Document Item","storeabill-core","woocommerce-germanized-pro"):"document_total"===e?t=Object(d._x)("Document Total","storeabill-core","woocommerce-germanized-pro"):"setting"===e&&(t=Object(d._x)("Settings","storeabill-core","woocommerce-germanized-pro")),t}function Q(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"",t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"",n=arguments.length>2&&void 0!==arguments[2]&&arguments[2],r=s("shortcodes"),o=Object.entries(r),i=["blocks","setting","document"],c={};o.forEach((function(r,o){var l=r[0];if((!(e.length>0&&e!==l)||Object(v.includes)(i,l))&&("blocks"!==l||0!==t.length)){var a=[],u=J(l);if(Object(v.isArray)(r[1]))a=r[1].flat();else if(t.length>0){a=r[1].hasOwnProperty(t)?r[1][t]:[];var s=Object(h.select)("core/blocks").getBlockType(t);u=s?s.title:t}c.hasOwnProperty(l)||(c[l]={label:u,value:l,children:{}}),a.map((function(e){if(!c[l].children.hasOwnProperty(e.shortcode)){if(!n&&e.hasOwnProperty("headerFooterOnly")&&e.headerFooterOnly)return;c[l].children[e.shortcode]={value:e.shortcode,label:e.title}}}))}}));var l=[];return Object.entries(c).map((function(e){var t=Object.values(e[1].children).flat();Object(v.isEmpty)(t)||l.push({value:e[1].value,label:e[1].label,children:t})})),l}function V(e){var t=s("shortcodes"),n=Object.entries(t),r={};return n.forEach((function(e,t){(Object(v.isArray)(e[1])?e[1].flat():Object.values(e[1]).flat()).map((function(e){r.hasOwnProperty(e.shortcode)||(r[e.shortcode]=e)}))})),!!r.hasOwnProperty(e)&&r[e]}function U(e){var t=V(e);return t?t.title:""}function $(){return s("dateTypes")}function G(){return s("barcodeTypes")}function X(){return s("barcodeCodeTypes")}function Z(e){var t=s("dateTypes"),n=Object(d._x)("Date","storeabill-core","woocommerce-germanized-pro");return Object.entries(t).map((function(t){t[0]===e&&(n=t[1])})),n}function ee(e){try{e=parseFloat(e),"invoice_cancellation"===s("documentType")&&(e*=-1);var t=s("priceFormat").decimals,n=s("priceFormat").decimal_separator,r=s("priceFormat").thousand_separator,o=s("priceFormat").currency,i=s("priceFormat").format;t=Math.abs(t),t=isNaN(t)?2:t;var c=e<0?"-":"",l=parseInt(e=Math.abs(Number(e)||0).toFixed(t)).toString(),a=l.length>3?l.length%3:0,u=c+(a?l.substr(0,a)+r:"")+l.substr(a).replace(/(\d{3})(?=\d)/g,"$1"+r)+(t?n+Math.abs(e-l).toFixed(t).slice(2):"");return i.replace("%s",o).replace("%v",u)}catch(t){return e}}function te(e){var t=Object(w.addQueryArgs)("/sab/v1/preview_shortcodes",{query:e,document_type:s("documentType")});return O()({path:t})}n.d(t,"getItemMetaTypes",(function(){return j})),n.d(t,"blockHasParent",(function(){return _})),n.d(t,"documentTypeSupports",(function(){return k})),n.d(t,"getDefaultInnerBlocks",(function(){return x})),n.d(t,"getItemMetaTypePreview",(function(){return P})),n.d(t,"getPreview",(function(){return B})),n.d(t,"getPreviewItem",(function(){return S})),n.d(t,"getItemTotalTypeDefaultTitle",(function(){return E})),n.d(t,"getItemTotalTypeTitle",(function(){return C})),n.d(t,"getPreviewTotal",(function(){return A})),n.d(t,"getPreviewTaxRate",(function(){return F})),n.d(t,"getPreviewDiscountNotice",(function(){return I})),n.d(t,"getPreviewVoucherNotice",(function(){return D})),n.d(t,"getPreviewFeeName",(function(){return M})),n.d(t,"formatMargins",(function(){return N})),n.d(t,"isDocumentTemplate",(function(){return z})),n.d(t,"getAllowedBlockTypes",(function(){return L})),n.d(t,"getDocumentStylesBlock",(function(){return R})),n.d(t,"getFonts",(function(){return Y})),n.d(t,"getFont",(function(){return K})),n.d(t,"getCurrentFonts",(function(){return W})),n.d(t,"getFontsCSS",(function(){return q})),n.d(t,"getItemTotalKey",(function(){return H})),n.d(t,"getShortcodeCategoryTitle",(function(){return J})),n.d(t,"getAvailableShortcodeTree",(function(){return Q})),n.d(t,"getShortcodeData",(function(){return V})),n.d(t,"getShortcodeTitle",(function(){return U})),n.d(t,"getDateTypes",(function(){return $})),n.d(t,"getBarcodeTypes",(function(){return G})),n.d(t,"getBarcodeCodeTypes",(function(){return X})),n.d(t,"getDateTypeTitle",(function(){return Z})),n.d(t,"formatPrice",(function(){return ee})),n.d(t,"getShortcodePreview",(function(){return te})),n.d(t,"ITEM_TOTAL_TYPES",(function(){return f})),n.d(t,"ITEM_META_TYPES",(function(){return p})),n.d(t,"ITEM_TABLE_BLOCK_TYPES",(function(){return b})),n.d(t,"DISCOUNT_TOTAL_TYPES",(function(){return g})),n.d(t,"FORMAT_TYPES",(function(){return m})),n.d(t,"setSetting",(function(){return T})),n.d(t,"getSetting",(function(){return s}))}});