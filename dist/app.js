var P=Object.create;var{defineProperty:v,getPrototypeOf:x,getOwnPropertyNames:S}=Object;var T=Object.prototype.hasOwnProperty;var A=(o,r,s)=>{s=o!=null?P(x(o)):{};const l=r||!o||!o.__esModule?v(s,"default",{value:o,enumerable:!0}):s;for(let m of S(o))if(!T.call(l,m))v(l,m,{get:()=>o[m],enumerable:!0});return l};var N=(o,r)=>()=>(r||o((r={exports:{}}).exports,r),r.exports);var b=N((g,w)=>{(function(o,r){typeof g=="object"&&typeof w!="undefined"?w.exports=r():typeof define=="function"&&define.amd?define(r):(o=o||self).JSONFormatter=r()})(g,function(){function o(e){return e===null?"null":typeof e}function r(e){return!!e&&typeof e=="object"}function s(e){if(e===void 0)return"";if(e===null)return"Object";if(typeof e=="object"&&!e.constructor)return"Object";var t=/function ([^(]*)/.exec(e.constructor.toString());return t&&t.length>1?t[1]:""}function l(e,t,n){return e==="null"||e==="undefined"?e:(e!=="string"&&e!=="stringifiable"||(n='"'+n.replace(/"/g,'\\"')+'"'),e==="function"?t.toString().replace(/[\r\n]/g,"").replace(/\{.*\}/,"")+"{\u2026}":n)}function m(e){var t="";return r(e)?(t=s(e),Array.isArray(e)&&(t+="["+e.length+"]")):t=l(o(e),e,e),t}function a(e){return"json-formatter-"+e}function c(e,t,n){var i=document.createElement(e);return t&&i.classList.add(a(t)),n!==void 0&&(n instanceof Node?i.appendChild(n):i.appendChild(document.createTextNode(String(n)))),i}(function(e){if(e&&typeof window!="undefined"){var t=document.createElement("style");t.setAttribute("media","screen"),t.innerHTML=e,document.head.appendChild(t)}})(`.json-formatter-row {
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
`);var C=/(^\d{1,4}[\.|\\/|-]\d{1,2}[\.|\\/|-]\d{1,4})(\s*(?:0?[1-9]:[0-5]|1(?=[012])\d:[0-5])\d\s*[ap]m)?$/,E=/\d{2}:\d{2}:\d{2} GMT-\d{4}/,L=/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}.\d{3}Z/,u=window.requestAnimationFrame||function(e){return e(),0},j={hoverPreviewEnabled:!1,hoverPreviewArrayCount:100,hoverPreviewFieldCount:5,animateOpen:!0,animateClose:!0,theme:null,useToJSON:!0,sortPropertiesBy:null};return function(){function e(t,n,i,f){n===void 0&&(n=1),i===void 0&&(i=j),this.json=t,this.open=n,this.config=i,this.key=f,this._isOpen=null,this.config.hoverPreviewEnabled===void 0&&(this.config.hoverPreviewEnabled=j.hoverPreviewEnabled),this.config.hoverPreviewArrayCount===void 0&&(this.config.hoverPreviewArrayCount=j.hoverPreviewArrayCount),this.config.hoverPreviewFieldCount===void 0&&(this.config.hoverPreviewFieldCount=j.hoverPreviewFieldCount),this.config.useToJSON===void 0&&(this.config.useToJSON=j.useToJSON),this.key===""&&(this.key='""')}return Object.defineProperty(e.prototype,"isOpen",{get:function(){return this._isOpen!==null?this._isOpen:this.open>0},set:function(t){this._isOpen=t},enumerable:!0,configurable:!0}),Object.defineProperty(e.prototype,"isDate",{get:function(){return this.json instanceof Date||this.type==="string"&&(C.test(this.json)||L.test(this.json)||E.test(this.json))},enumerable:!0,configurable:!0}),Object.defineProperty(e.prototype,"isUrl",{get:function(){return this.type==="string"&&this.json.indexOf("http")===0},enumerable:!0,configurable:!0}),Object.defineProperty(e.prototype,"isArray",{get:function(){return Array.isArray(this.json)},enumerable:!0,configurable:!0}),Object.defineProperty(e.prototype,"isObject",{get:function(){return r(this.json)},enumerable:!0,configurable:!0}),Object.defineProperty(e.prototype,"isEmptyObject",{get:function(){return!this.keys.length&&!this.isArray},enumerable:!0,configurable:!0}),Object.defineProperty(e.prototype,"isEmpty",{get:function(){return this.isEmptyObject||this.keys&&!this.keys.length&&this.isArray},enumerable:!0,configurable:!0}),Object.defineProperty(e.prototype,"useToJSON",{get:function(){return this.config.useToJSON&&this.type==="stringifiable"},enumerable:!0,configurable:!0}),Object.defineProperty(e.prototype,"hasKey",{get:function(){return this.key!==void 0},enumerable:!0,configurable:!0}),Object.defineProperty(e.prototype,"constructorName",{get:function(){return s(this.json)},enumerable:!0,configurable:!0}),Object.defineProperty(e.prototype,"type",{get:function(){return this.config.useToJSON&&this.json&&this.json.toJSON?"stringifiable":o(this.json)},enumerable:!0,configurable:!0}),Object.defineProperty(e.prototype,"keys",{get:function(){if(this.isObject){var t=Object.keys(this.json);return!this.isArray&&this.config.sortPropertiesBy?t.sort(this.config.sortPropertiesBy):t}return[]},enumerable:!0,configurable:!0}),e.prototype.toggleOpen=function(){this.isOpen=!this.isOpen,this.element&&(this.isOpen?this.appendChildren(this.config.animateOpen):this.removeChildren(this.config.animateClose),this.element.classList.toggle(a("open")))},e.prototype.openAtDepth=function(t){t===void 0&&(t=1),t<0||(this.open=t,this.isOpen=t!==0,this.element&&(this.removeChildren(!1),t===0?this.element.classList.remove(a("open")):(this.appendChildren(this.config.animateOpen),this.element.classList.add(a("open")))))},e.prototype.getInlinepreview=function(){var t=this;if(this.isArray)return this.json.length>this.config.hoverPreviewArrayCount?"Array["+this.json.length+"]":"["+this.json.map(m).join(", ")+"]";var n=this.keys,i=n.slice(0,this.config.hoverPreviewFieldCount).map(function(d){return d+":"+m(t.json[d])}),f=n.length>=this.config.hoverPreviewFieldCount?"\u2026":"";return"{"+i.join(", ")+f+"}"},e.prototype.render=function(){this.element=c("div","row");var t=this.isObject?c("a","toggler-link"):c("span");if(this.isObject&&!this.useToJSON&&t.appendChild(c("span","toggler")),this.hasKey&&t.appendChild(c("span","key",this.key+":")),this.isObject&&!this.useToJSON){var n=c("span","value"),i=c("span"),f=c("span","constructor-name",this.constructorName);if(i.appendChild(f),this.isArray){var d=c("span");d.appendChild(c("span","bracket","[")),d.appendChild(c("span","number",this.json.length)),d.appendChild(c("span","bracket","]")),i.appendChild(d)}n.appendChild(i),t.appendChild(n)}else{(n=this.isUrl?c("a"):c("span")).classList.add(a(this.type)),this.isDate&&n.classList.add(a("date")),this.isUrl&&(n.classList.add(a("url")),n.setAttribute("href",this.json));var p=l(this.type,this.json,this.useToJSON?this.json.toJSON():this.json);n.appendChild(document.createTextNode(p)),t.appendChild(n)}if(this.isObject&&this.config.hoverPreviewEnabled){var h=c("span","preview-text");h.appendChild(document.createTextNode(this.getInlinepreview())),t.appendChild(h)}var y=c("div","children");return this.isObject&&y.classList.add(a("object")),this.isArray&&y.classList.add(a("array")),this.isEmpty&&y.classList.add(a("empty")),this.config&&this.config.theme&&this.element.classList.add(a(this.config.theme)),this.isOpen&&this.element.classList.add(a("open")),this.element.appendChild(t),this.element.appendChild(y),this.isObject&&this.isOpen&&this.appendChildren(),this.isObject&&!this.useToJSON&&t.addEventListener("click",this.toggleOpen.bind(this)),this.element},e.prototype.appendChildren=function(t){var n=this;t===void 0&&(t=!1);var i=this.element.querySelector("div."+a("children"));if(i&&!this.isEmpty)if(t){var f=0,d=function(){var p=n.keys[f],h=new e(n.json[p],n.open-1,n.config,p);i.appendChild(h.render()),(f+=1)<n.keys.length&&(f>10?d():u(d))};u(d)}else this.keys.forEach(function(p){var h=new e(n.json[p],n.open-1,n.config,p);i.appendChild(h.render())})},e.prototype.removeChildren=function(t){t===void 0&&(t=!1);var n=this.element.querySelector("div."+a("children"));if(t){var i=0,f=function(){n&&n.children.length&&(n.removeChild(n.children[0]),(i+=1)>10?f():u(f))};u(f)}else n&&(n.innerHTML="")},e}()})});var O=A(b(),1);var k=async()=>{let o=null;try{const r=await fetch("/wp-json/wpc2o/v1/stock-sync",{method:"get",headers:{"Content-Type":"application/json"}});if(r.ok)o=await r.json()}catch(r){o={status:!1,message:"There was a problem requesting a stock sync."}}return o};document.querySelectorAll(".wpc2o-expand-details").forEach((o)=>{o?.addEventListener("click",(r)=>{r.preventDefault(),o?.nextElementSibling?.classList.toggle("show")})});document.addEventListener("DOMContentLoaded",function(){document.querySelectorAll(".wpc2o-code-block").forEach((r)=>{const s=r.getElementsByTagName("code")[0],l=new O.default(JSON.parse(s.innerText),Infinity);r.removeChild(s),r.appendChild(l.render())})});document.addEventListener("DOMContentLoaded",()=>{const o=document.getElementById("wpc2o-example-json");if(o)document.getElementById("wpc2o-expand-api-request")?.addEventListener("click",(r)=>{r.preventDefault(),o.classList.toggle("wpc2o-example-show")}),document.getElementById("wpc2o-copy-api-request")?.addEventListener("click",(r)=>{r.preventDefault(),navigator.clipboard.writeText(o.innerText)}),document.getElementById("wpc2o-manual-stock-sync-trigger")?.addEventListener("submit",async(r)=>{r.preventDefault();const s=document.getElementById("wpc2o-manual-stock-sync-trigger-button");if(s)s.disabled=!0;const l=document.createElement("span");l.id="wpc2o-manual-stock-sync-message",l.style.display="block",l.style.marginBottom="16px",l.innerText="Sync in progress... please do NOT close this page.",l.style.color="#3858e9",l.style.fontWeight="500",s?.after(l);const m=document.getElementById("wpc2o-manual-stock-sync-message"),a=await k();if(m&&a){const c=a.status?"green":"red";l.style.color=c,m.innerText=a.message}if(s)s.disabled=!1})});document.addEventListener("DOMContentLoaded",()=>{document.querySelectorAll(".wpc2o-view-order-payload").forEach((o)=>{o?.addEventListener("click",(r)=>{r.preventDefault();const s=o.nextElementSibling;if(s)s.classList.toggle("open")})}),document.querySelectorAll(".wpc2o-view-payload-modal-close").forEach((o)=>{o.addEventListener("click",(r)=>{r.preventDefault(),document.querySelectorAll(".wpc2o-view-payload-modal.open").forEach((s)=>s.classList.toggle("open"))})}),document.querySelectorAll(".wpc2o-view-payload-modal-copy").forEach((o)=>{o.addEventListener("click",(r)=>{r.preventDefault();const s=document.querySelector(".wpc2o-view-payload-modal.open .wpc2o-view-payload-modal-content");if(s)navigator.clipboard.writeText(s.innerText)})})});
