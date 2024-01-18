var S=Object.create;var{defineProperty:F,getPrototypeOf:U,getOwnPropertyNames:V}=Object;var W=Object.prototype.hasOwnProperty;var X=(h,w,j)=>{j=h!=null?S(U(h)):{};const A=w||!h||!h.__esModule?F(j,"default",{value:h,enumerable:!0}):j;for(let L of V(h))if(!W.call(A,L))F(A,L,{get:()=>h[L],enumerable:!0});return A};var Y=(h,w)=>()=>(w||h((w={exports:{}}).exports,w),w.exports);var G=Y((B,D)=>{(function(h,w){typeof B=="object"&&typeof D!="undefined"?D.exports=w():typeof define=="function"&&define.amd?define(w):(h=h||self).JSONFormatter=w()})(B,function(){function h(y){return y===null?"null":typeof y}function w(y){return!!y&&typeof y=="object"}function j(y){if(y===void 0)return"";if(y===null)return"Object";if(typeof y=="object"&&!y.constructor)return"Object";var f=/function ([^(]*)/.exec(y.constructor.toString());return f&&f.length>1?f[1]:""}function A(y,f,p){return y==="null"||y==="undefined"?y:(y!=="string"&&y!=="stringifiable"||(p='"'+p.replace(/"/g,'\\"')+'"'),y==="function"?f.toString().replace(/[\r\n]/g,"").replace(/\{.*\}/,"")+"{\u2026}":p)}function L(y){var f="";return w(y)?(f=j(y),Array.isArray(y)&&(f+="["+y.length+"]")):f=A(h(y),y,y),f}function k(y){return"json-formatter-"+y}function q(y,f,p){var i=document.createElement(y);return f&&i.classList.add(k(f)),p!==void 0&&(p instanceof Node?i.appendChild(p):i.appendChild(document.createTextNode(String(p)))),i}(function(y){if(y&&typeof window!="undefined"){var f=document.createElement("style");f.setAttribute("media","screen"),f.innerHTML=y,document.head.appendChild(f)}})(`.json-formatter-row {
  font-family: monospace;
}
.json-formatter-row,
.json-formatter-row a,
.json-formatter-row a:hover {
  color: black;
  text-decoration: none;
}
.json-formatter-row .json-formatter-row {
  margin-left: 1rem;
}
.json-formatter-row .json-formatter-children.json-formatter-empty {
  opacity: 0.5;
  margin-left: 1rem;
}
.json-formatter-row .json-formatter-children.json-formatter-empty:after {
  display: none;
}
.json-formatter-row .json-formatter-children.json-formatter-empty.json-formatter-object:after {
  content: "No properties";
}
.json-formatter-row .json-formatter-children.json-formatter-empty.json-formatter-array:after {
  content: "[]";
}
.json-formatter-row .json-formatter-string,
.json-formatter-row .json-formatter-stringifiable {
  color: green;
  white-space: pre;
  word-wrap: break-word;
}
.json-formatter-row .json-formatter-number {
  color: blue;
}
.json-formatter-row .json-formatter-boolean {
  color: red;
}
.json-formatter-row .json-formatter-null {
  color: #855A00;
}
.json-formatter-row .json-formatter-undefined {
  color: #ca0b69;
}
.json-formatter-row .json-formatter-function {
  color: #FF20ED;
}
.json-formatter-row .json-formatter-date {
  background-color: rgba(0, 0, 0, 0.05);
}
.json-formatter-row .json-formatter-url {
  text-decoration: underline;
  color: blue;
  cursor: pointer;
}
.json-formatter-row .json-formatter-bracket {
  color: blue;
}
.json-formatter-row .json-formatter-key {
  color: #00008B;
  padding-right: 0.2rem;
}
.json-formatter-row .json-formatter-toggler-link {
  cursor: pointer;
}
.json-formatter-row .json-formatter-toggler {
  line-height: 1.2rem;
  font-size: 0.7rem;
  vertical-align: middle;
  opacity: 0.6;
  cursor: pointer;
  padding-right: 0.2rem;
}
.json-formatter-row .json-formatter-toggler:after {
  display: inline-block;
  transition: transform 100ms ease-in;
  content: "\u25BA";
}
.json-formatter-row > a > .json-formatter-preview-text {
  opacity: 0;
  transition: opacity 0.15s ease-in;
  font-style: italic;
}
.json-formatter-row:hover > a > .json-formatter-preview-text {
  opacity: 0.6;
}
.json-formatter-row.json-formatter-open > .json-formatter-toggler-link .json-formatter-toggler:after {
  transform: rotate(90deg);
}
.json-formatter-row.json-formatter-open > .json-formatter-children:after {
  display: inline-block;
}
.json-formatter-row.json-formatter-open > a > .json-formatter-preview-text {
  display: none;
}
.json-formatter-row.json-formatter-open.json-formatter-empty:after {
  display: block;
}
.json-formatter-dark.json-formatter-row {
  font-family: monospace;
}
.json-formatter-dark.json-formatter-row,
.json-formatter-dark.json-formatter-row a,
.json-formatter-dark.json-formatter-row a:hover {
  color: white;
  text-decoration: none;
}
.json-formatter-dark.json-formatter-row .json-formatter-row {
  margin-left: 1rem;
}
.json-formatter-dark.json-formatter-row .json-formatter-children.json-formatter-empty {
  opacity: 0.5;
  margin-left: 1rem;
}
.json-formatter-dark.json-formatter-row .json-formatter-children.json-formatter-empty:after {
  display: none;
}
.json-formatter-dark.json-formatter-row .json-formatter-children.json-formatter-empty.json-formatter-object:after {
  content: "No properties";
}
.json-formatter-dark.json-formatter-row .json-formatter-children.json-formatter-empty.json-formatter-array:after {
  content: "[]";
}
.json-formatter-dark.json-formatter-row .json-formatter-string,
.json-formatter-dark.json-formatter-row .json-formatter-stringifiable {
  color: #31F031;
  white-space: pre;
  word-wrap: break-word;
}
.json-formatter-dark.json-formatter-row .json-formatter-number {
  color: #66C2FF;
}
.json-formatter-dark.json-formatter-row .json-formatter-boolean {
  color: #EC4242;
}
.json-formatter-dark.json-formatter-row .json-formatter-null {
  color: #EEC97D;
}
.json-formatter-dark.json-formatter-row .json-formatter-undefined {
  color: #ef8fbe;
}
.json-formatter-dark.json-formatter-row .json-formatter-function {
  color: #FD48CB;
}
.json-formatter-dark.json-formatter-row .json-formatter-date {
  background-color: rgba(255, 255, 255, 0.05);
}
.json-formatter-dark.json-formatter-row .json-formatter-url {
  text-decoration: underline;
  color: #027BFF;
  cursor: pointer;
}
.json-formatter-dark.json-formatter-row .json-formatter-bracket {
  color: #9494FF;
}
.json-formatter-dark.json-formatter-row .json-formatter-key {
  color: #23A0DB;
  padding-right: 0.2rem;
}
.json-formatter-dark.json-formatter-row .json-formatter-toggler-link {
  cursor: pointer;
}
.json-formatter-dark.json-formatter-row .json-formatter-toggler {
  line-height: 1.2rem;
  font-size: 0.7rem;
  vertical-align: middle;
  opacity: 0.6;
  cursor: pointer;
  padding-right: 0.2rem;
}
.json-formatter-dark.json-formatter-row .json-formatter-toggler:after {
  display: inline-block;
  transition: transform 100ms ease-in;
  content: "\u25BA";
}
.json-formatter-dark.json-formatter-row > a > .json-formatter-preview-text {
  opacity: 0;
  transition: opacity 0.15s ease-in;
  font-style: italic;
}
.json-formatter-dark.json-formatter-row:hover > a > .json-formatter-preview-text {
  opacity: 0.6;
}
.json-formatter-dark.json-formatter-row.json-formatter-open > .json-formatter-toggler-link .json-formatter-toggler:after {
  transform: rotate(90deg);
}
.json-formatter-dark.json-formatter-row.json-formatter-open > .json-formatter-children:after {
  display: inline-block;
}
.json-formatter-dark.json-formatter-row.json-formatter-open > a > .json-formatter-preview-text {
  display: none;
}
.json-formatter-dark.json-formatter-row.json-formatter-open.json-formatter-empty:after {
  display: block;
}
`);var O=/(^\d{1,4}[\.|\\/|-]\d{1,2}[\.|\\/|-]\d{1,4})(\s*(?:0?[1-9]:[0-5]|1(?=[012])\d:[0-5])\d\s*[ap]m)?$/,Q=/\d{2}:\d{2}:\d{2} GMT-\d{4}/,R=/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}.\d{3}Z/,x=window.requestAnimationFrame||function(y){return y(),0},b={hoverPreviewEnabled:!1,hoverPreviewArrayCount:100,hoverPreviewFieldCount:5,animateOpen:!0,animateClose:!0,theme:null,useToJSON:!0,sortPropertiesBy:null};return function(){function y(f,p,i,C){p===void 0&&(p=1),i===void 0&&(i=b),this.json=f,this.open=p,this.config=i,this.key=C,this._isOpen=null,this.config.hoverPreviewEnabled===void 0&&(this.config.hoverPreviewEnabled=b.hoverPreviewEnabled),this.config.hoverPreviewArrayCount===void 0&&(this.config.hoverPreviewArrayCount=b.hoverPreviewArrayCount),this.config.hoverPreviewFieldCount===void 0&&(this.config.hoverPreviewFieldCount=b.hoverPreviewFieldCount),this.config.useToJSON===void 0&&(this.config.useToJSON=b.useToJSON),this.key===""&&(this.key='""')}return Object.defineProperty(y.prototype,"isOpen",{get:function(){return this._isOpen!==null?this._isOpen:this.open>0},set:function(f){this._isOpen=f},enumerable:!0,configurable:!0}),Object.defineProperty(y.prototype,"isDate",{get:function(){return this.json instanceof Date||this.type==="string"&&(O.test(this.json)||R.test(this.json)||Q.test(this.json))},enumerable:!0,configurable:!0}),Object.defineProperty(y.prototype,"isUrl",{get:function(){return this.type==="string"&&this.json.indexOf("http")===0},enumerable:!0,configurable:!0}),Object.defineProperty(y.prototype,"isArray",{get:function(){return Array.isArray(this.json)},enumerable:!0,configurable:!0}),Object.defineProperty(y.prototype,"isObject",{get:function(){return w(this.json)},enumerable:!0,configurable:!0}),Object.defineProperty(y.prototype,"isEmptyObject",{get:function(){return!this.keys.length&&!this.isArray},enumerable:!0,configurable:!0}),Object.defineProperty(y.prototype,"isEmpty",{get:function(){return this.isEmptyObject||this.keys&&!this.keys.length&&this.isArray},enumerable:!0,configurable:!0}),Object.defineProperty(y.prototype,"useToJSON",{get:function(){return this.config.useToJSON&&this.type==="stringifiable"},enumerable:!0,configurable:!0}),Object.defineProperty(y.prototype,"hasKey",{get:function(){return this.key!==void 0},enumerable:!0,configurable:!0}),Object.defineProperty(y.prototype,"constructorName",{get:function(){return j(this.json)},enumerable:!0,configurable:!0}),Object.defineProperty(y.prototype,"type",{get:function(){return this.config.useToJSON&&this.json&&this.json.toJSON?"stringifiable":h(this.json)},enumerable:!0,configurable:!0}),Object.defineProperty(y.prototype,"keys",{get:function(){if(this.isObject){var f=Object.keys(this.json);return!this.isArray&&this.config.sortPropertiesBy?f.sort(this.config.sortPropertiesBy):f}return[]},enumerable:!0,configurable:!0}),y.prototype.toggleOpen=function(){this.isOpen=!this.isOpen,this.element&&(this.isOpen?this.appendChildren(this.config.animateOpen):this.removeChildren(this.config.animateClose),this.element.classList.toggle(k("open")))},y.prototype.openAtDepth=function(f){f===void 0&&(f=1),f<0||(this.open=f,this.isOpen=f!==0,this.element&&(this.removeChildren(!1),f===0?this.element.classList.remove(k("open")):(this.appendChildren(this.config.animateOpen),this.element.classList.add(k("open")))))},y.prototype.getInlinepreview=function(){var f=this;if(this.isArray)return this.json.length>this.config.hoverPreviewArrayCount?"Array["+this.json.length+"]":"["+this.json.map(L).join(", ")+"]";var p=this.keys,i=p.slice(0,this.config.hoverPreviewFieldCount).map(function(I){return I+":"+L(f.json[I])}),C=p.length>=this.config.hoverPreviewFieldCount?"\u2026":"";return"{"+i.join(", ")+C+"}"},y.prototype.render=function(){this.element=q("div","row");var f=this.isObject?q("a","toggler-link"):q("span");if(this.isObject&&!this.useToJSON&&f.appendChild(q("span","toggler")),this.hasKey&&f.appendChild(q("span","key",this.key+":")),this.isObject&&!this.useToJSON){var p=q("span","value"),i=q("span"),C=q("span","constructor-name",this.constructorName);if(i.appendChild(C),this.isArray){var I=q("span");I.appendChild(q("span","bracket","[")),I.appendChild(q("span","number",this.json.length)),I.appendChild(q("span","bracket","]")),i.appendChild(I)}p.appendChild(i),f.appendChild(p)}else{(p=this.isUrl?q("a"):q("span")).classList.add(k(this.type)),this.isDate&&p.classList.add(k("date")),this.isUrl&&(p.classList.add(k("url")),p.setAttribute("href",this.json));var P=A(this.type,this.json,this.useToJSON?this.json.toJSON():this.json);p.appendChild(document.createTextNode(P)),f.appendChild(p)}if(this.isObject&&this.config.hoverPreviewEnabled){var T=q("span","preview-text");T.appendChild(document.createTextNode(this.getInlinepreview())),f.appendChild(T)}var z=q("div","children");return this.isObject&&z.classList.add(k("object")),this.isArray&&z.classList.add(k("array")),this.isEmpty&&z.classList.add(k("empty")),this.config&&this.config.theme&&this.element.classList.add(k(this.config.theme)),this.isOpen&&this.element.classList.add(k("open")),this.element.appendChild(f),this.element.appendChild(z),this.isObject&&this.isOpen&&this.appendChildren(),this.isObject&&!this.useToJSON&&f.addEventListener("click",this.toggleOpen.bind(this)),this.element},y.prototype.appendChildren=function(f){var p=this;f===void 0&&(f=!1);var i=this.element.querySelector("div."+k("children"));if(i&&!this.isEmpty)if(f){var C=0,I=function(){var P=p.keys[C],T=new y(p.json[P],p.open-1,p.config,P);i.appendChild(T.render()),(C+=1)<p.keys.length&&(C>10?I():x(I))};x(I)}else this.keys.forEach(function(P){var T=new y(p.json[P],p.open-1,p.config,P);i.appendChild(T.render())})},y.prototype.removeChildren=function(f){f===void 0&&(f=!1);var p=this.element.querySelector("div."+k("children"));if(f){var i=0,C=function(){p&&p.children.length&&(p.removeChild(p.children[0]),(i+=1)>10?C():x(C))};x(C)}else p&&(p.innerHTML="")},y}()})});var K=X(G(),1);var H=async()=>{let h=null;try{const w=await fetch("/wp-json/wpc2o/v1/stock-sync",{method:"get",headers:{"Content-Type":"application/json"}});if(w.ok)h=await w.json()}catch(w){h={status:!1,message:"There was a problem requesting a stock sync."}}return h};document.querySelectorAll(".wpc2o-expand-details").forEach((h)=>{h?.addEventListener("click",(w)=>{w.preventDefault(),h?.nextElementSibling?.classList.toggle("show")})});document.addEventListener("DOMContentLoaded",function(){document.querySelectorAll(".wpc2o-code-block").forEach((w)=>{const j=w.getElementsByTagName("code")[0],A=new K.default(JSON.parse(j.innerText),Infinity);w.removeChild(j),w.appendChild(A.render())})});document.addEventListener("DOMContentLoaded",()=>{const h=document.getElementById("wpc2o-example-json");if(h)document.getElementById("wpc2o-expand-api-request")?.addEventListener("click",(w)=>{w.preventDefault(),h.classList.toggle("wpc2o-example-show")}),document.getElementById("wpc2o-copy-api-request")?.addEventListener("click",(w)=>{w.preventDefault(),navigator.clipboard.writeText(h.innerText)}),document.getElementById("wpc2o-manual-stock-sync-trigger")?.addEventListener("submit",async(w)=>{w.preventDefault();const j=document.getElementById("wpc2o-manual-stock-sync-trigger-button");if(j)j.disabled=!0;const A=document.createElement("span");A.id="wpc2o-manual-stock-sync-message",A.style.display="block",A.style.marginBottom="16px",A.innerText="Sync in progress... please do NOT close this page.",A.style.color="#3858e9",A.style.fontWeight="500",j?.after(A);const L=document.getElementById("wpc2o-manual-stock-sync-message"),k=await H();if(L&&k){const q=k.status?"green":"red";A.style.color=q,L.innerText=k.message}if(j)j.disabled=!1})});document.addEventListener("DOMContentLoaded",()=>{document.querySelectorAll(".wpc2o-view-order-payload").forEach((h)=>{h?.addEventListener("click",(w)=>{w.preventDefault();const j=h.nextElementSibling;if(j)j.classList.toggle("open")})}),document.querySelectorAll(".wpc2o-view-payload-modal-close").forEach((h)=>{h.addEventListener("click",(w)=>{w.preventDefault(),document.querySelectorAll(".wpc2o-view-payload-modal.open").forEach((j)=>j.classList.toggle("open"))})}),document.querySelectorAll(".wpc2o-view-payload-modal-copy").forEach((h)=>{h.addEventListener("click",(w)=>{w.preventDefault();const j=document.querySelector(".wpc2o-view-payload-modal.open .wpc2o-view-payload-modal-content");if(j)navigator.clipboard.writeText(j.innerText)})})});
