this.sab=this.sab||{},this.sab.blocks=this.sab.blocks||{},this.sab.blocks["item-image"]=function(e){function t(t){for(var n,i,l=t[0],a=t[1],h=t[2],s=0,v=[];s<l.length;s++)i=l[s],Object.prototype.hasOwnProperty.call(c,i)&&c[i]&&v.push(c[i][0]),c[i]=0;for(n in a)Object.prototype.hasOwnProperty.call(a,n)&&(e[n]=a[n]);for(u&&u(t);v.length;)v.shift()();return o.push.apply(o,h||[]),r()}function r(){for(var e,t=0;t<o.length;t++){for(var r=o[t],n=!0,l=1;l<r.length;l++){var a=r[l];0!==c[a]&&(n=!1)}n&&(o.splice(t--,1),e=i(i.s=r[0]))}return e}var n={},c={22:0,17:0,40:0},o=[];function i(t){if(n[t])return n[t].exports;var r=n[t]={i:t,l:!1,exports:{}};return e[t].call(r.exports,r,r.exports,i),r.l=!0,r.exports}i.m=e,i.c=n,i.d=function(e,t,r){i.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},i.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},i.t=function(e,t){if(1&t&&(e=i(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(i.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var n in e)i.d(r,n,function(t){return e[t]}.bind(null,n));return r},i.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return i.d(t,"a",t),t},i.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},i.p="";var l=window.webpackStoreaBillJsonp=window.webpackStoreaBillJsonp||[],a=l.push.bind(l);l.push=t,l=l.slice();for(var h=0;h<l.length;h++)t(l[h]);var u=a;return o.push([105,0]),r()}({0:function(e,t){e.exports=window.wp.element},1:function(e,t){e.exports=window.wp.components},10:function(e,t){e.exports=window.wp.primitives},105:function(e,t,r){"use strict";r.r(t);var n=r(4),c=r(15),o=(r(7),r(14)),i=r(0),l=(r(9),r(3)),a=r(1),h=r(8);var u=function(e){var t=e.attributes,r=e.setAttributes,c=(e.className,t.customWidth),o=Object(h.getSetting)("assets_url")+"images/placeholder.png",u={maxWidth:c+"px",width:c+"px"};return Object(i.createElement)(i.Fragment,null,Object(i.createElement)(l.InspectorControls,null,Object(i.createElement)(a.PanelBody,null,Object(i.createElement)(a.RangeControl,{label:Object(n._x)("Width","storeabill-core","woocommerce-germanized-pro"),value:c,onChange:function(e){return r({customWidth:e})},min:25,max:100}))),Object(i.createElement)("div",null,Object(i.createElement)("img",{src:o,style:u,alt:"",className:"sab-document-image-placeholder"})))},s={title:Object(n._x)("Item Image","storeabill-core","woocommerce-germanized-pro"),description:Object(n._x)("Inserts the item image.","storeabill-core","woocommerce-germanized-pro"),category:"storeabill",icon:o.img,parent:["storeabill/item-table-column"],example:{},attributes:{customWidth:{type:"number"},isDisabled:{type:"boolean",default:!1},itemType:{type:"string",default:""}},edit:u};Object(c.registerBlockType)("storeabill/item-image",s)},11:function(e,t){e.exports=window.wp.apiFetch},12:function(e,t){e.exports=window.wp.url},14:function(e,t,r){"use strict";r.r(t);var n=r(5),c=r.n(n),o=r(16),i=r.n(o),l=r(24),a=["srcElement","size"];function h(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}var u=function(e){var t=e.srcElement,r=e.size,n=void 0===r?24:r,o=i()(e,a);return Object(l.isValidElement)(t)&&Object(l.cloneElement)(t,function(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?h(Object(r),!0).forEach((function(t){c()(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):h(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}({width:n,height:n},o))},s=r(0),v=r(1),d=Object(s.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24",width:"24",height:"24"},Object(s.createElement)("path",{d:"M15 18.5c-2.51 0-4.68-1.42-5.76-3.5H15v-2H8.58c-.05-.33-.08-.66-.08-1s.03-.67.08-1H15V9H9.24C10.32 6.92 12.5 5.5 15 5.5c1.61 0 3.09.59 4.23 1.57L21 5.3C19.41 3.87 17.3 3 15 3c-3.92 0-7.24 2.51-8.48 6H3v2h3.06c-.04.33-.06.66-.06 1 0 .34.02.67.06 1H3v2h3.52c1.24 3.49 4.56 6 8.48 6 2.31 0 4.41-.87 6-2.3l-1.78-1.77c-1.13.98-2.6 1.57-4.22 1.57z"}),Object(s.createElement)("path",{d:"M0 0h24v24H0z",fill:"none"})),m=Object(s.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24",width:"24",height:"24"},Object(s.createElement)("path",{d:"M7 21h2v-2H7v2zm0-8h2v-2H7v2zm4 0h2v-2h-2v2zm0 8h2v-2h-2v2zm-8-4h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2v-2H3v2zm0-4h2V7H3v2zm8 8h2v-2h-2v2zm8-8h2V7h-2v2zm0 4h2v-2h-2v2zM3 3v2h18V3H3zm16 14h2v-2h-2v2zm-4 4h2v-2h-2v2zM11 9h2V7h-2v2zm8 12h2v-2h-2v2zm-4-8h2v-2h-2v2z"}),"        ",Object(s.createElement)("path",{d:"M0 0h24v24H0z",fill:"none"}),Object(s.createElement)("path",{d:"M0 0h24v24H0z",fill:"none"})),f=Object(s.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24",width:"24",height:"24"},Object(s.createElement)("path",{d:"M9 11H7v2h2v-2zm4 4h-2v2h2v-2zM9 3H7v2h2V3zm4 8h-2v2h2v-2zM5 3H3v2h2V3zm8 4h-2v2h2V7zm4 4h-2v2h2v-2zm-4-8h-2v2h2V3zm4 0h-2v2h2V3zm2 10h2v-2h-2v2zm0 4h2v-2h-2v2zM5 7H3v2h2V7zm14-4v2h2V3h-2zm0 6h2V7h-2v2zM5 11H3v2h2v-2zM3 21h18v-2H3v2zm2-6H3v2h2v-2z"}),Object(s.createElement)("path",{d:"M0 0h24v24H0z",fill:"none"})),b=Object(s.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24",width:"24",height:"24"},Object(s.createElement)("path",{d:"M11 21h2v-2h-2v2zm0-4h2v-2h-2v2zm0-12h2V3h-2v2zm0 4h2V7h-2v2zm0 4h2v-2h-2v2zm-4 8h2v-2H7v2zM7 5h2V3H7v2zm0 8h2v-2H7v2zm-4 8h2V3H3v18zM19 9h2V7h-2v2zm-4 12h2v-2h-2v2zm4-4h2v-2h-2v2zm0-14v2h2V3h-2zm0 10h2v-2h-2v2zm0 8h2v-2h-2v2zm-4-8h2v-2h-2v2zm0-8h2V3h-2v2z"}),Object(s.createElement)("path",{d:"M0 0h24v24H0z",fill:"none"})),p=Object(s.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24",width:"24",height:"24"},Object(s.createElement)("path",{d:"M7 21h2v-2H7v2zM3 5h2V3H3v2zm4 0h2V3H7v2zm0 8h2v-2H7v2zm-4 8h2v-2H3v2zm8 0h2v-2h-2v2zm-8-8h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm8 8h2v-2h-2v2zm4-4h2v-2h-2v2zm4-10v18h2V3h-2zm-4 18h2v-2h-2v2zm0-16h2V3h-2v2zm-4 8h2v-2h-2v2zm0-8h2V3h-2v2zm0 4h2V7h-2v2z"}),Object(s.createElement)("path",{d:"M0 0h24v24H0z",fill:"none"})),g=Object(s.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24",width:"24",height:"24"},Object(s.createElement)("path",{d:"M7 5h2V3H7v2zm0 8h2v-2H7v2zm0 8h2v-2H7v2zm4-4h2v-2h-2v2zm0 4h2v-2h-2v2zm-8 0h2v-2H3v2zm0-4h2v-2H3v2zm0-4h2v-2H3v2zm0-4h2V7H3v2zm0-4h2V3H3v2zm8 8h2v-2h-2v2zm8 4h2v-2h-2v2zm0-4h2v-2h-2v2zm0 8h2v-2h-2v2zm0-12h2V7h-2v2zm-8 0h2V7h-2v2zm8-6v2h2V3h-2zm-8 2h2V3h-2v2zm4 16h2v-2h-2v2zm0-8h2v-2h-2v2zm0-8h2V3h-2v2z"}),Object(s.createElement)("path",{d:"M0 0h24v24H0z",fill:"none"})),O=Object(s.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24",width:"24",height:"24"},Object(s.createElement)("path",{d:"M3 21h2v-2H3v2zm4 0h2v-2H7v2zM5 7H3v2h2V7zM3 17h2v-2H3v2zM9 3H7v2h2V3zM5 3H3v2h2V3zm12 0h-2v2h2V3zm2 6h2V7h-2v2zm0-6v2h2V3h-2zm-4 18h2v-2h-2v2zM13 3h-2v8H3v2h8v8h2v-8h8v-2h-8V3zm6 18h2v-2h-2v2zm0-4h2v-2h-2v2z"}),Object(s.createElement)("path",{d:"M0 0h24v24H0z",fill:"none"})),w=Object(s.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24",width:"24",height:"24"},Object(s.createElement)("path",{d:"M13 7h-2v2h2V7zm0 4h-2v2h2v-2zm4 0h-2v2h2v-2zM3 3v18h18V3H3zm16 16H5V5h14v14zm-6-4h-2v2h2v-2zm-4-4H7v2h2v-2z"}),Object(s.createElement)("path",{d:"M0 0h24v24H0z",fill:"none"})),j=Object(s.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24",width:"24",height:"24"},Object(s.createElement)("path",{d:"M3 21h2v-2H3v2zM5 7H3v2h2V7zM3 17h2v-2H3v2zm4 4h2v-2H7v2zM5 3H3v2h2V3zm4 0H7v2h2V3zm8 0h-2v2h2V3zm-4 4h-2v2h2V7zm0-4h-2v2h2V3zm6 14h2v-2h-2v2zm-8 4h2v-2h-2v2zm-8-8h18v-2H3v2zM19 3v2h2V3h-2zm0 6h2V7h-2v2zm-8 8h2v-2h-2v2zm4 4h2v-2h-2v2zm4 0h2v-2h-2v2z"}),Object(s.createElement)("path",{d:"M0 0h24v24H0z",fill:"none"})),z=r(10),y=Object(s.createElement)(z.SVG,{viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},Object(s.createElement)(z.Path,{d:"M8.5,21.4l1.9,0.5l5.2-19.3l-1.9-0.5L8.5,21.4z M3,19h4v-2H5V7h2V5H3V19z M17,5v2h2v10h-2v2h4V5H17z"})),E=Object(s.createElement)(z.SVG,{viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},Object(s.createElement)("path",{d:"M0 0h24v24H0z",fill:"none"}),Object(s.createElement)("path",{d:"M9 4v3h5v12h3V7h5V4H9zm-6 8h3v7h3v-7h3V9H3v3z"})),V=Object(s.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24",width:"24",height:"24"},Object(s.createElement)("path",{d:"M0 0h24v24H0z",fill:"none"}),Object(s.createElement)("path",{d:"M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"}),Object(s.createElement)("path",{d:"M12.5 7H11v6l5.25 3.15.75-1.23-4.5-2.67z"})),x=Object(s.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24",width:"24",height:"24"},Object(s.createElement)("path",{d:"M0 0h24v24H0z",fill:"none"}),Object(s.createElement)("path",{d:"M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"})),M=Object(s.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24",width:"24",height:"24"},Object(s.createElement)("path",{d:"M0 0h24v24H0z",fill:"none"}),Object(s.createElement)("path",{d:"M20.5 11H19V7c0-1.1-.9-2-2-2h-4V3.5C13 2.12 11.88 1 10.5 1S8 2.12 8 3.5V5H4c-1.1 0-1.99.9-1.99 2v3.8H3.5c1.49 0 2.7 1.21 2.7 2.7s-1.21 2.7-2.7 2.7H2V20c0 1.1.9 2 2 2h3.8v-1.5c0-1.49 1.21-2.7 2.7-2.7 1.49 0 2.7 1.21 2.7 2.7V22H17c1.1 0 2-.9 2-2v-4h1.5c1.38 0 2.5-1.12 2.5-2.5S21.88 11 20.5 11z"})),H=Object(s.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24",width:"24",height:"24"},Object(s.createElement)("path",{d:"M0 0h24v24H0z",fill:"none"}),Object(s.createElement)("path",{d:"M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41 0-.55-.23-1.06-.59-1.42zM5.5 7C4.67 7 4 6.33 4 5.5S4.67 4 5.5 4 7 4.67 7 5.5 6.33 7 5.5 7z"})),S=Object(s.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24",width:"24",height:"24"},Object(s.createElement)("path",{d:"M0 0h24v24H0z",fill:"none"}),Object(s.createElement)("path",{d:"M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14h-2V9h-2V7h4v10z"})),C=Object(s.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24",width:"24",height:"24"},Object(s.createElement)("path",{d:"M0 0h24v24H0V0z",fill:"none"}),Object(s.createElement)("path",{d:"M5 4v3h5.5v12h3V7H19V4z"})),T=Object(s.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24",width:"24",height:"24"},Object(s.createElement)("g",null,Object(s.createElement)("path",{d:"M0,0h24v24H0V0z",fill:"none"}),Object(s.createElement)("path",{d:"M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.07-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.74,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.8,11.69,4.8,12s0.02,0.64,0.07,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.44-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.47-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"}))),P=Object(s.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24",width:"24",height:"24"},Object(s.createElement)("path",{d:"M0 0h24v24H0V0z",fill:"none"}),Object(s.createElement)("path",{d:"M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"})),_=Object(s.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24",width:"24",height:"24"},Object(s.createElement)("path",{d:"M0 0h24v24H0z",fill:"none"}),Object(s.createElement)("path",{d:"M17.81 4.47c-.08 0-.16-.02-.23-.06C15.66 3.42 14 3 12.01 3c-1.98 0-3.86.47-5.57 1.41-.24.13-.54.04-.68-.2-.13-.24-.04-.55.2-.68C7.82 2.52 9.86 2 12.01 2c2.13 0 3.99.47 6.03 1.52.25.13.34.43.21.67-.09.18-.26.28-.44.28zM3.5 9.72c-.1 0-.2-.03-.29-.09-.23-.16-.28-.47-.12-.7.99-1.4 2.25-2.5 3.75-3.27C9.98 4.04 14 4.03 17.15 5.65c1.5.77 2.76 1.86 3.75 3.25.16.22.11.54-.12.7-.23.16-.54.11-.7-.12-.9-1.26-2.04-2.25-3.39-2.94-2.87-1.47-6.54-1.47-9.4.01-1.36.7-2.5 1.7-3.4 2.96-.08.14-.23.21-.39.21zm6.25 12.07c-.13 0-.26-.05-.35-.15-.87-.87-1.34-1.43-2.01-2.64-.69-1.23-1.05-2.73-1.05-4.34 0-2.97 2.54-5.39 5.66-5.39s5.66 2.42 5.66 5.39c0 .28-.22.5-.5.5s-.5-.22-.5-.5c0-2.42-2.09-4.39-4.66-4.39-2.57 0-4.66 1.97-4.66 4.39 0 1.44.32 2.77.93 3.85.64 1.15 1.08 1.64 1.85 2.42.19.2.19.51 0 .71-.11.1-.24.15-.37.15zm7.17-1.85c-1.19 0-2.24-.3-3.1-.89-1.49-1.01-2.38-2.65-2.38-4.39 0-.28.22-.5.5-.5s.5.22.5.5c0 1.41.72 2.74 1.94 3.56.71.48 1.54.71 2.54.71.24 0 .64-.03 1.04-.1.27-.05.53.13.58.41.05.27-.13.53-.41.58-.57.11-1.07.12-1.21.12zM14.91 22c-.04 0-.09-.01-.13-.02-1.59-.44-2.63-1.03-3.72-2.1-1.4-1.39-2.17-3.24-2.17-5.22 0-1.62 1.38-2.94 3.08-2.94 1.7 0 3.08 1.32 3.08 2.94 0 1.07.93 1.94 2.08 1.94s2.08-.87 2.08-1.94c0-3.77-3.25-6.83-7.25-6.83-2.84 0-5.44 1.58-6.61 4.03-.39.81-.59 1.76-.59 2.8 0 .78.07 2.01.67 3.61.1.26-.03.55-.29.64-.26.1-.55-.04-.64-.29-.49-1.31-.73-2.61-.73-3.96 0-1.2.23-2.29.68-3.24 1.33-2.79 4.28-4.6 7.51-4.6 4.55 0 8.25 3.51 8.25 7.83 0 1.62-1.38 2.94-3.08 2.94s-3.08-1.32-3.08-2.94c0-1.07-.93-1.94-2.08-1.94s-2.08.87-2.08 1.94c0 1.71.66 3.31 1.87 4.51.95.94 1.86 1.46 3.27 1.85.27.07.42.35.35.61-.05.23-.26.38-.47.38z"})),k=Object(s.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24",width:"24",height:"24"},Object(s.createElement)("path",{d:"M0 0h24v24H0V0z",fill:"none"}),Object(s.createElement)("path",{d:"M19 5v14H5V5h14m0-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-4.86 8.86l-3 3.87L9 13.14 6 17h12l-3.86-5.14z"})),B=Object(s.createElement)(v.SVG,{x:"0.0000mm",y:"0.0000mm",width:"2.5cm",viewBox:"0.0000 0.0000 50.2710 20.4580",xmlns:"http://www.w3.org/2000/svg"},Object(s.createElement)("g",null,Object(s.createElement)("rect",{x:"0.0000",y:"0.0000",width:"0.5292",height:"20.1864"}),Object(s.createElement)("rect",{x:"2.1167",y:"0.0000",width:"0.5292",height:"20.1864"}),Object(s.createElement)("rect",{x:"3.1750",y:"0.0000",width:"1.5875",height:"20.1864"}),Object(s.createElement)("rect",{x:"5.2917",y:"0.0000",width:"1.5875",height:"20.1864"}),Object(s.createElement)("rect",{x:"7.4084",y:"0.0000",width:"0.5292",height:"20.1864"}),Object(s.createElement)("rect",{x:"8.4667",y:"0.0000",width:"1.5875",height:"20.1864"}),Object(s.createElement)("rect",{x:"10.5834",y:"0.0000",width:"0.5292",height:"20.1864"}),Object(s.createElement)("rect",{x:"12.7000",y:"0.0000",width:"0.5292",height:"20.1864"}),Object(s.createElement)("rect",{x:"13.7584",y:"0.0000",width:"0.5292",height:"20.1864"}),Object(s.createElement)("rect",{x:"14.8167",y:"0.0000",width:"1.5875",height:"20.1864"}),Object(s.createElement)("rect",{x:"16.9334",y:"0.0000",width:"0.5292",height:"20.1864"}),Object(s.createElement)("rect",{x:"17.9917",y:"0.0000",width:"1.5875",height:"20.1864"}),Object(s.createElement)("rect",{x:"21.1667",y:"0.0000",width:"0.5292",height:"20.1864"}),Object(s.createElement)("rect",{x:"22.2251",y:"0.0000",width:"0.5292",height:"20.1864"}),Object(s.createElement)("rect",{x:"23.2834",y:"0.0000",width:"1.5875",height:"20.1864"}),Object(s.createElement)("rect",{x:"25.4001",y:"0.0000",width:"1.5875",height:"20.1864"}),Object(s.createElement)("rect",{x:"27.5168",y:"0.0000",width:"1.5875",height:"20.1864"}),Object(s.createElement)("rect",{x:"30.6918",y:"0.0000",width:"0.5292",height:"20.1864"}),Object(s.createElement)("rect",{x:"31.7501",y:"0.0000",width:"0.5292",height:"20.1864"}),Object(s.createElement)("rect",{x:"32.8084",y:"0.0000",width:"0.5292",height:"20.1864"}),Object(s.createElement)("rect",{x:"33.8668",y:"0.0000",width:"0.5292",height:"20.1864"}),Object(s.createElement)("rect",{x:"34.9251",y:"0.0000",width:"0.5292",height:"20.1864"}),Object(s.createElement)("rect",{x:"37.0418",y:"0.0000",width:"1.5875",height:"20.1864"}),Object(s.createElement)("rect",{x:"39.1585",y:"0.0000",width:"0.5292",height:"20.1864"}),Object(s.createElement)("rect",{x:"40.2168",y:"0.0000",width:"1.5875",height:"20.1864"}),Object(s.createElement)("rect",{x:"42.3335",y:"0.0000",width:"0.5292",height:"20.1864"}),Object(s.createElement)("rect",{x:"44.4501",y:"0.0000",width:"0.5292",height:"20.1864"}),Object(s.createElement)("rect",{x:"45.5085",y:"0.0000",width:"1.5875",height:"20.1864"}),Object(s.createElement)("rect",{x:"47.6252",y:"0.0000",width:"1.5875",height:"20.1864"}),Object(s.createElement)("rect",{x:"49.7418",y:"0.0000",width:"0.5292",height:"20.1864"}))),G=Object(s.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24",width:"24",height:"24"},Object(s.createElement)("g",null,Object(s.createElement)("rect",{fill:"none",height:"24",width:"24"})),Object(s.createElement)("path",{d:"M15,21h-2v-2h2V21z M13,14h-2v5h2V14z M21,12h-2v4h2V12z M19,10h-2v2h2V10z M7,12H5v2h2V12z M5,10H3v2h2V10z M12,5h2V3h-2V5 z M4.5,4.5v3h3v-3H4.5z M9,9H3V3h6V9z M4.5,16.5v3h3v-3H4.5z M9,21H3v-6h6V21z M16.5,4.5v3h3v-3H16.5z M21,9h-6V3h6V9z M19,19v-3 l-4,0v2h2v3h4v-2H19z M17,12l-4,0v2h4V12z M13,10H7v2h2v2h2v-2h2V10z M14,9V7h-2V5h-2v4L14,9z M6.75,5.25h-1.5v1.5h1.5V5.25z M6.75,17.25h-1.5v1.5h1.5V17.25z M18.75,5.25h-1.5v1.5h1.5V5.25z"})),D=Object(s.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24",width:"24",height:"24"},Object(s.createElement)("path",{d:"M0 0h24v24H0z",fill:"none"}),Object(s.createElement)("path",{d:"M19 5v14H5V5h14m0-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"}));r.d(t,"Icon",(function(){return u})),r.d(t,"euro",(function(){return d})),r.d(t,"borderTop",(function(){return m})),r.d(t,"borderBottom",(function(){return f})),r.d(t,"borderLeft",(function(){return b})),r.d(t,"borderRight",(function(){return p})),r.d(t,"borderClear",(function(){return g})),r.d(t,"borderInner",(function(){return O})),r.d(t,"borderOuter",(function(){return w})),r.d(t,"borderHorizontal",(function(){return j})),r.d(t,"shortcode",(function(){return y})),r.d(t,"fontSize",(function(){return E})),r.d(t,"date",(function(){return V})),r.d(t,"address",(function(){return x})),r.d(t,"meta",(function(){return M})),r.d(t,"discount",(function(){return H})),r.d(t,"quantity",(function(){return S})),r.d(t,"title",(function(){return C})),r.d(t,"settings",(function(){return T})),r.d(t,"arrowRight",(function(){return P})),r.d(t,"fingerprint",(function(){return _})),r.d(t,"img",(function(){return k})),r.d(t,"barcode",(function(){return B})),r.d(t,"qrCode",(function(){return G})),r.d(t,"field",(function(){return D}))},15:function(e,t){e.exports=window.wp.blocks},2:function(e,t){e.exports=window.lodash},24:function(e,t){e.exports=window.React},3:function(e,t){e.exports=window.wp.blockEditor},4:function(e,t){e.exports=window.wp.i18n},6:function(e,t){e.exports=window.wp.data},7:function(e,t,r){"use strict";var n=r(2),c=r(3),o=r(18),i=r.n(o),l=r(17),a=r.n(l),h=r(5),u=r.n(h),s=r(0),v=r(20),d=r.n(v),m=r(9),f=r.n(m),b=r(4),p=r(6),g=r(13),O=r.n(g),w=r(16),j=r.n(w),z=["backgroundColor","textColor"],y=function(e,t,r){return"function"==typeof e?e(t):!0===e?r:e};function E(e){var t=e.title,r=e.colorSettings,o=e.colorPanelProps,i=e.contrastCheckers,l=e.detectedBackgroundColor,a=e.detectedColor,h=e.panelChildren,u=e.initialOpen;return Object(s.createElement)(c.PanelColorSettings,O()({title:t,initialOpen:u,colorSettings:Object.values(r)},o),i&&(Array.isArray(i)?i.map((function(e){var t=e.backgroundColor,n=e.textColor,o=j()(e,z);return t=y(t,r,l),n=y(n,r,a),Object(s.createElement)(c.ContrastChecker,O()({key:"".concat(t,"-").concat(n),backgroundColor:t,textColor:n},o))})):Object(n.map)(r,(function(e){var t=e.value,n=i.backgroundColor,o=i.textColor;return n=y(n||t,r,l),o=y(o||t,r,a),Object(s.createElement)(c.ContrastChecker,O()({},i,{key:"".concat(n,"-").concat(o),backgroundColor:n,textColor:o}))}))),"function"==typeof h?h(r):h)}function V(e,t){var r="undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(!r){if(Array.isArray(e)||(r=function(e,t){if(!e)return;if("string"==typeof e)return x(e,t);var r=Object.prototype.toString.call(e).slice(8,-1);"Object"===r&&e.constructor&&(r=e.constructor.name);if("Map"===r||"Set"===r)return Array.from(e);if("Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r))return x(e,t)}(e))||t&&e&&"number"==typeof e.length){r&&(e=r);var n=0,c=function(){};return{s:c,n:function(){return n>=e.length?{done:!0}:{done:!1,value:e[n++]}},e:function(e){throw e},f:c}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var o,i=!0,l=!1;return{s:function(){r=r.call(e)},n:function(){var e=r.next();return i=e.done,e},e:function(e){l=!0,o=e},f:function(){try{i||null==r.return||r.return()}finally{if(l)throw o}}}}function x(e,t){(null==t||t>e.length)&&(t=e.length);for(var r=0,n=new Array(t);r<t;r++)n[r]=e[r];return n}function M(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function H(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?M(Object(r),!0).forEach((function(t){u()(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):M(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}function S(e){return e.ownerDocument.defaultView.getComputedStyle(e)}var C=[],T={textColor:Object(b.__)("Text color"),backgroundColor:Object(b.__)("Background color")},P=function(e){return Object(s.createElement)(c.InspectorControls,null,Object(s.createElement)(E,e))};r.d(t,"g",(function(){return _})),r.d(t,"b",(function(){return k})),r.d(t,"a",(function(){return B})),r.d(t,"c",(function(){return G})),r.d(t,"e",(function(){return D})),r.d(t,"d",(function(){return N})),r.d(t,"f",(function(){return I}));var _=void 0===c.__experimentalUseColors?function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{panelTitle:Object(b.__)("Color")},r=t.panelTitle,o=void 0===r?Object(b.__)("Color"):r,l=t.colorPanelProps,h=t.contrastCheckers,v=t.panelChildren,m=t.colorDetector,g=void 0===m?{}:m,O=g.targetRef,w=g.backgroundColorTargetRef,j=void 0===w?O:w,z=g.textColorTargetRef,y=void 0===z?O:z,x=arguments.length>2&&void 0!==arguments[2]?arguments[2]:[],M=Object(c.useBlockEditContext)(),_=M.clientId,k=Object(c.useSetting)("color.palette")||C,B=Object(p.useSelect)((function(e){return{attributes:(0,e(c.store).getBlockAttributes)(_)}}),[_]),G=B.attributes,D=Object(p.useDispatch)(c.store),N=D.updateBlockAttributes,I=Object(s.useCallback)((function(e){return N(_,e)}),[N,_]),A=Object(s.useMemo)((function(){return d()((function(e,t,r,c,o,i){return function(l){var a,h=l.children,v=l.className,d=void 0===v?"":v,m=l.style,b=void 0===m?{}:m,p={};c?p=u()({},t,o):i&&(p=u()({},t,i));var g={className:f()(d,(a={},u()(a,"has-".concat(Object(n.kebabCase)(c),"-").concat(Object(n.kebabCase)(t)),c),u()(a,r||"has-".concat(Object(n.kebabCase)(e)),c||i),a)),style:H(H({},p),b)};return Object(n.isFunction)(h)?h(g):s.Children.map(h,(function(e){return Object(s.cloneElement)(e,{className:f()(e.props.className,g.className),style:H(H({},g.style),e.props.style||{})})}))}}),{maxSize:e.length})}),[e.length]),L=Object(s.useMemo)((function(){return d()((function(e,t){return function(r){var c=t.find((function(e){return e.color===r}));I(u()({},c?Object(n.camelCase)("custom ".concat(e)):e,void 0)),I(u()({},c?e:Object(n.camelCase)("custom ".concat(e)),c?c.slug:r))}}),{maxSize:e.length})}),[I,e.length]),F=Object(s.useState)(),R=a()(F,2),W=R[0],Y=R[1],q=Object(s.useState)(),U=a()(q,2),$=U[0],J=U[1];return Object(s.useEffect)((function(){if(h){var e,t=!1,r=!1,c=V(Object(n.castArray)(h));try{for(c.s();!(e=c.n()).done;){var o=e.value,i=o.backgroundColor,l=o.textColor;if(t||(t=!0===i),r||(r=!0===l),t&&r)break}}catch(e){c.e(e)}finally{c.f()}if(r&&J(S(y.current).color),t){for(var a=j.current,u=S(a).backgroundColor;"rgba(0, 0, 0, 0)"===u&&a.parentNode&&a.parentNode.nodeType===a.parentNode.ELEMENT_NODE;)u=S(a=a.parentNode).backgroundColor;Y(u)}}}),[e.reduce((function(e,t){return"".concat(e," | ").concat(G[t.name]," | ").concat(G[Object(n.camelCase)("custom ".concat(t.name))])}),"")].concat(i()(x))),Object(s.useMemo)((function(){var t={},r=e.reduce((function(e,r){"string"==typeof r&&(r={name:r});var c=H(H({},r),{},{color:G[r.name]}),o=c.name,i=c.property,l=void 0===i?o:i,a=c.className,h=c.panelLabel,u=void 0===h?r.label||T[o]||Object(n.startCase)(o):h,s=c.componentName,v=void 0===s?Object(n.startCase)(o).replace(/\s/g,""):s,d=c.color,m=void 0===d?r.color:d,f=c.colors,b=void 0===f?k:f,p=G[Object(n.camelCase)("custom ".concat(o))],g=p?void 0:b.find((function(e){return e.slug===m}));return e[v]=A(o,l,a,m,g&&g.color,p),e[v].displayName=v,e[v].color=p||g&&g.color,e[v].slug=m,e[v].setColor=L(o,b),t[v]={value:g?g.color:G[Object(n.camelCase)("custom ".concat(o))],onChange:e[v].setColor,label:u,colors:b},b||delete t[v].colors,e}),{}),c={title:o,initialOpen:!1,colorSettings:t,colorPanelProps:l,contrastCheckers:h,detectedBackgroundColor:W,detectedColor:$,panelChildren:v};return H(H({},r),{},{ColorPanel:Object(s.createElement)(E,c),InspectorControlsColorPanel:Object(s.createElement)(P,c)})}),[G,I,$,W].concat(i()(x)))}:c.__experimentalUseColors;function k(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"";return'<span class="placeholder-content '+(Object(n.isEmpty)(t)?"":"sab-tooltip")+'" contenteditable="false" '+(Object(n.isEmpty)(t)?"":'data-tooltip="'+t+'"')+'><span class="editor-placeholder"></span>'+e+"</span>"}function B(e){return"string"==typeof e&&/^\d+$/.test(e)&&(e=parseInt(e)),e}function G(e){var t,r=e;return e&&e.hasOwnProperty("size")&&(r=e.size),r?(t=r,isNaN(parseFloat(t))||isNaN(t-0)?r:r+"px"):void 0}function D(e,t,r,c){var o=arguments.length>4&&void 0!==arguments[4]?arguments[4]:"";return e&&Object(n.includes)(e,r)||(e=Object(n.includes)(e,"{default}")?e.replace("{default}",c||k(r,o)):c||k(r,o)),e.replace(r,t)}function N(e,t,r){return e.replace(r,t)}function I(e,t){var r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"placeholder-content",n=arguments.length>3&&void 0!==arguments[3]&&arguments[3],c=(new DOMParser).parseFromString(e,"text/html"),o=!1;if((o=n?c.querySelectorAll("[data-shortcode='"+r+"']"):c.getElementsByClassName(r)).length>0){var i=o[0].getElementsByClassName("editor-placeholder");if(i.length>0){for(var l=i[0].nextSibling,a=[];l;)l!==i[0]&&a.push(l),l=l.nextSibling;a.forEach((function(e){i[0].parentNode.removeChild(e)})),i[0].insertAdjacentHTML("afterEnd",t)}else o[0].innerHTML='<span class="editor-placeholder"></span>'+t;o[0].classList.remove("document-shortcode-needs-refresh"),e=c.body.innerHTML}return e}},8:function(e,t,r){"use strict";r.r(t);var n=r(5),c=r.n(n),o=r(21);function i(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function l(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?i(Object(r),!0).forEach((function(t){c()(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):i(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}var a="object"===("undefined"==typeof sabSettings?"undefined":r.n(o)()(sabSettings))?sabSettings:{},h=l(l({},{itemTotalTypes:[],itemMetaTypes:[],itemTableBlockTypes:[],discountTotalTypes:{}}),a);function u(e){var t=arguments.length>1&&void 0!==arguments[1]&&arguments[1],r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:function(e){return e},n=h.hasOwnProperty(e)?h[e]:t;return r(n,t)}var s=r(4),v=h.itemTotalTypes,d=h.itemMetaTypes,m=h.itemTableBlockTypes,f=h.discountTotalTypes,b=["core/bold","core/italic","core/text-color","core/underline","storeabill/document-shortcode","storeabill/font-size"],p=r(6),g=r(2),O=r(11),w=r.n(O),j=r(12);r(1);function z(e,t){var r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:function(e){return e};h[e]=r(t)}function y(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"";return e=""===e?u("mainLineItemType"):e,d.hasOwnProperty(e)?d[e]:[]}function E(e,t){Array.isArray(t)||(t=[t]);var r=Object(p.select)("core/block-editor").getBlockParents(e);if(r.length>0){var n=Object(p.select)("core/block-editor").getBlock(r[0]);if(Object(g.includes)(t,n.name))return!0}return!1}function V(e){var t=u("supports");return Object(g.includes)(t,e)}function x(e){var t=u("defaultInnerBlocks");return t.hasOwnProperty(e)?t[e]:[]}function M(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"product",r=y(t),n=r.filter((function(t){if(e===t.type)return!0})),c=n.length>0?n[0].preview:"",o=S(t),i=o.meta_data.filter((function(t){if(e===t.key)return!0}));return i.length>0?i[0].value:c}function H(){return u("preview",{})}function S(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"";e=""===e?u("mainLineItemType"):e;var t=H();return t[e+"_items"][0]}function C(e){var t=v.filter((function(t){if(e===t.type)return!0}));return t&&t[0]?t[0].default:""}function T(e){var t=v.filter((function(t){if(e===t.type)return!0}));return t&&t[0]?t[0].title:""}function P(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"total",t=!(arguments.length>1&&void 0!==arguments[1])||arguments[1],r=H(),n=r.totals,c=n.filter((function(t){return t.type===e}));return c.length>0?t?c[0].total_formatted:c[0].total:0}function _(){var e=H().tax_items;return e.length>0?e[0].rate.percent:"{rate}"}function k(){return H().formatted_discount_notice}function B(){var e=H().voucher_items;return e.length>0?e[0].code:"{code}"}function G(){var e=H().fee_items;return e.length>0?e[0].name:"{name}"}function D(e,t){var r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"read",n={top:e.top?e.top:t.top,left:e.left?e.left:t.left,right:e.right?e.right:t.right,bottom:e.bottom?e.bottom:t.bottom};if("edit"===r){var c=u("marginTypesSupported"),o={};return c.forEach((function(e){o[e]=n[e]})),o}return n}function N(){return"document_template"===Object(p.select)("core/editor").getCurrentPostType()}function I(){return u("allowedBlockTypes")}function A(){var e=void 0,t=(0,Object(p.select)("core/block-editor").getBlocks)().filter((function(e){if("storeabill/document-styles"===e.name)return e}));return t.length>0&&(e=t[0]),e}function L(){return u("fonts")}function F(e){var t=L().filter((function(t){if(t.name===e)return!0}));if(!Object(g.isEmpty)(t))return t[0]}function R(){var e=(0,Object(p.select)("core/editor").getEditedPostAttribute)("meta");return e._fonts?e._fonts:void 0}function W(e){e=e||R();var t=Object(j.addQueryArgs)("/sab/v1/preview_fonts/css",{fonts:e,display_types:u("fontDisplayTypes")});return w()({path:t})}function Y(e){var t=!(arguments.length>1&&void 0!==arguments[1])||arguments[1],r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"",n=e;return"before_discounts"===r&&(n+="_subtotal",Object(g.includes)(e,"total")&&(n=e.replace("total","")),"total"===e?n="subtotal":"total_tax"===e&&(n="subtotal_tax")),!1!==t||Object(g.includes)(e,"_tax")||(Object(g.includes)(e,"_total")&&(n=n.replace("_total","")),n+="_net"),n+"_formatted"}function q(e){var t="";return"document"===e?t=Object(s._x)("Document","storeabill-core","woocommerce-germanized-pro"):"document_item"===e?t=Object(s._x)("Document Item","storeabill-core","woocommerce-germanized-pro"):"document_total"===e?t=Object(s._x)("Document Total","storeabill-core","woocommerce-germanized-pro"):"setting"===e&&(t=Object(s._x)("Settings","storeabill-core","woocommerce-germanized-pro")),t}function U(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"",t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"",r=arguments.length>2&&void 0!==arguments[2]&&arguments[2],n=u("shortcodes"),c=Object.entries(n),o=["blocks","setting","document"],i={};c.forEach((function(n,c){var l=n[0];if((!(e.length>0&&e!==l)||Object(g.includes)(o,l))&&("blocks"!==l||0!==t.length)){var a=[],h=q(l);if(Object(g.isArray)(n[1]))a=n[1].flat();else if(t.length>0){a=n[1].hasOwnProperty(t)?n[1][t]:[];var u=Object(p.select)("core/blocks").getBlockType(t);h=u?u.title:t}i.hasOwnProperty(l)||(i[l]={label:h,value:l,children:{}}),a.map((function(e){if(!i[l].children.hasOwnProperty(e.shortcode)){if(!r&&e.hasOwnProperty("headerFooterOnly")&&e.headerFooterOnly)return;i[l].children[e.shortcode]={value:e.shortcode,label:e.title}}}))}}));var l=[];return Object.entries(i).map((function(e){var t=Object.values(e[1].children).flat();Object(g.isEmpty)(t)||l.push({value:e[1].value,label:e[1].label,children:t})})),l}function $(e){var t=u("shortcodes"),r=Object.entries(t),n={};return r.forEach((function(e,t){(Object(g.isArray)(e[1])?e[1].flat():Object.values(e[1]).flat()).map((function(e){n.hasOwnProperty(e.shortcode)||(n[e.shortcode]=e)}))})),!!n.hasOwnProperty(e)&&n[e]}function J(e){var t=$(e);return t?t.title:""}function K(){return u("dateTypes")}function Q(){return u("barcodeTypes")}function X(){return u("barcodeCodeTypes")}function Z(e){var t=u("dateTypes"),r=Object(s._x)("Date","storeabill-core","woocommerce-germanized-pro");return Object.entries(t).map((function(t){t[0]===e&&(r=t[1])})),r}function ee(e){try{e=parseFloat(e),"invoice_cancellation"===u("documentType")&&(e*=-1);var t=u("priceFormat").decimals,r=u("priceFormat").decimal_separator,n=u("priceFormat").thousand_separator,c=u("priceFormat").currency,o=u("priceFormat").format;t=Math.abs(t),t=isNaN(t)?2:t;var i=e<0?"-":"",l=parseInt(e=Math.abs(Number(e)||0).toFixed(t)).toString(),a=l.length>3?l.length%3:0,h=i+(a?l.substr(0,a)+n:"")+l.substr(a).replace(/(\d{3})(?=\d)/g,"$1"+n)+(t?r+Math.abs(e-l).toFixed(t).slice(2):"");return o.replace("%s",c).replace("%v",h)}catch(t){return e}}function te(e){var t=Object(j.addQueryArgs)("/sab/v1/preview_shortcodes",{query:e,document_type:u("documentType")});return w()({path:t})}r.d(t,"getItemMetaTypes",(function(){return y})),r.d(t,"blockHasParent",(function(){return E})),r.d(t,"documentTypeSupports",(function(){return V})),r.d(t,"getDefaultInnerBlocks",(function(){return x})),r.d(t,"getItemMetaTypePreview",(function(){return M})),r.d(t,"getPreview",(function(){return H})),r.d(t,"getPreviewItem",(function(){return S})),r.d(t,"getItemTotalTypeDefaultTitle",(function(){return C})),r.d(t,"getItemTotalTypeTitle",(function(){return T})),r.d(t,"getPreviewTotal",(function(){return P})),r.d(t,"getPreviewTaxRate",(function(){return _})),r.d(t,"getPreviewDiscountNotice",(function(){return k})),r.d(t,"getPreviewVoucherNotice",(function(){return B})),r.d(t,"getPreviewFeeName",(function(){return G})),r.d(t,"formatMargins",(function(){return D})),r.d(t,"isDocumentTemplate",(function(){return N})),r.d(t,"getAllowedBlockTypes",(function(){return I})),r.d(t,"getDocumentStylesBlock",(function(){return A})),r.d(t,"getFonts",(function(){return L})),r.d(t,"getFont",(function(){return F})),r.d(t,"getCurrentFonts",(function(){return R})),r.d(t,"getFontsCSS",(function(){return W})),r.d(t,"getItemTotalKey",(function(){return Y})),r.d(t,"getShortcodeCategoryTitle",(function(){return q})),r.d(t,"getAvailableShortcodeTree",(function(){return U})),r.d(t,"getShortcodeData",(function(){return $})),r.d(t,"getShortcodeTitle",(function(){return J})),r.d(t,"getDateTypes",(function(){return K})),r.d(t,"getBarcodeTypes",(function(){return Q})),r.d(t,"getBarcodeCodeTypes",(function(){return X})),r.d(t,"getDateTypeTitle",(function(){return Z})),r.d(t,"formatPrice",(function(){return ee})),r.d(t,"getShortcodePreview",(function(){return te})),r.d(t,"ITEM_TOTAL_TYPES",(function(){return v})),r.d(t,"ITEM_META_TYPES",(function(){return d})),r.d(t,"ITEM_TABLE_BLOCK_TYPES",(function(){return m})),r.d(t,"DISCOUNT_TOTAL_TYPES",(function(){return f})),r.d(t,"FORMAT_TYPES",(function(){return b})),r.d(t,"setSetting",(function(){return z})),r.d(t,"getSetting",(function(){return u}))}});