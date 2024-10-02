function u(e){return e===null?"null":typeof e}function y(e){return!!e&&typeof e=="object"}function g(e){if(e===void 0)return"";if(e===null)return"Object";if(typeof e=="object"&&!e.constructor)return"Object";var t=/function ([^(]*)/.exec(e.constructor.toString());return t&&t.length>1?t[1]:""}function w(e,t,n){return e==="null"||e==="undefined"?e:(e!=="string"&&e!=="stringifiable"||(n='"'+(n.replace(/"/g,'\\"')+'"')),e==="function"?t.toString().replace(/[\r\n]/g,"").replace(/\{.*\}/,"")+"{\u2026}":n)}function j(e){var t="";return y(e)?(t=g(e),Array.isArray(e)&&(t+="["+e.length+"]")):t=w(u(e),e,e),t}function i(e){return"json-formatter-".concat(e)}function a(e,t,n){var r=document.createElement(e);return t&&r.classList.add(i(t)),n!==void 0&&(n instanceof Node?r.appendChild(n):r.appendChild(document.createTextNode(String(n)))),r}(function(e){if(e&&typeof window!="undefined"){var t=document.createElement("style");t.setAttribute("media","screen"),t.innerHTML=e,document.head.appendChild(t)}})(`.json-formatter-row {
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
  color: #855a00;
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
  color: #00008b;
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
  color: #31f031;
  white-space: pre;
  word-wrap: break-word;
}
.json-formatter-dark.json-formatter-row .json-formatter-number {
  color: #66c2ff;
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
  color: #027bff;
  cursor: pointer;
}
.json-formatter-dark.json-formatter-row .json-formatter-bracket {
  color: #9494ff;
}
.json-formatter-dark.json-formatter-row .json-formatter-key {
  color: #23a0db;
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
`);var O=/(^\d{1,4}[\.|\\/|-]\d{1,2}[\.|\\/|-]\d{1,4})(\s*(?:0?[1-9]:[0-5]|1(?=[012])\d:[0-5])\d\s*[ap]m)?$/,C=/\d{2}:\d{2}:\d{2} GMT-\d{4}/,A=/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}.\d{3}Z/,E=/^https?:\/\//,p=window.requestAnimationFrame||function(e){return e(),0},m={hoverPreviewEnabled:!1,hoverPreviewArrayCount:100,hoverPreviewFieldCount:5,animateOpen:!0,animateClose:!0,theme:null,useToJSON:!0,sortPropertiesBy:null,maxArrayItems:100,exposePath:!1},x=function(){function e(t,n,r,s,o,l,c){n===void 0&&(n=1),r===void 0&&(r=m),l===void 0&&(l=[]),this.json=t,this.open=n,this.config=r,this.key=s,this.displayKey=o,this.path=l,this.arrayRange=c,this._isOpen=null,this.config.hoverPreviewEnabled===void 0&&(this.config.hoverPreviewEnabled=m.hoverPreviewEnabled),this.config.hoverPreviewArrayCount===void 0&&(this.config.hoverPreviewArrayCount=m.hoverPreviewArrayCount),this.config.hoverPreviewFieldCount===void 0&&(this.config.hoverPreviewFieldCount=m.hoverPreviewFieldCount),this.config.useToJSON===void 0&&(this.config.useToJSON=m.useToJSON),this.config.maxArrayItems===void 0&&(this.config.maxArrayItems=m.maxArrayItems),this.key===""&&(this.key='""'),this.displayKey===void 0&&(this.displayKey=this.key)}return Object.defineProperty(e.prototype,"isOpen",{get:function(){return this._isOpen!==null?this._isOpen:this.open>0},set:function(t){this._isOpen=t},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"isDate",{get:function(){return this.json instanceof Date||this.type==="string"&&(O.test(this.json)||A.test(this.json)||C.test(this.json))},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"isUrl",{get:function(){return this.type==="string"&&E.test(this.json)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"isArray",{get:function(){return Array.isArray(this.json)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"isLargeArray",{get:function(){return this.isArray&&this.json.length>this.config.maxArrayItems},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"isArrayRange",{get:function(){return this.isArray&&this.arrayRange!==void 0&&this.arrayRange.length==2},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"isObject",{get:function(){return y(this.json)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"isEmptyObject",{get:function(){return!this.keys.length&&!this.isArray},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"isEmpty",{get:function(){return this.isEmptyObject||this.keys&&!this.keys.length&&this.isArray},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"useToJSON",{get:function(){return this.config.useToJSON&&this.type==="stringifiable"},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"hasKey",{get:function(){return this.key!==void 0},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"constructorName",{get:function(){return g(this.json)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"type",{get:function(){return this.config.useToJSON&&this.json&&this.json.toJSON?"stringifiable":u(this.json)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"keys",{get:function(){if(this.isObject){var t=Object.keys(this.json);if(this.isLargeArray){var n=Math.ceil(this.json.length/this.config.maxArrayItems);t=[];for(var r=0;r<n;r++){var s=r*this.config.maxArrayItems,o=Math.min(this.json.length-1,s+(this.config.maxArrayItems-1));t.push("".concat(s," \u2026 ").concat(o))}}return!this.isArray&&this.config.sortPropertiesBy?t.sort(this.config.sortPropertiesBy):t}return[]},enumerable:!1,configurable:!0}),e.prototype.toggleOpen=function(){this.isOpen=!this.isOpen,this.element&&(this.isOpen?this.appendChildren(this.config.animateOpen):this.removeChildren(this.config.animateClose),this.element.classList.toggle(i("open")))},e.prototype.openAtDepth=function(t){t===void 0&&(t=1),t<0||(this.open=t,this.isOpen=t!==0,this.element&&(this.removeChildren(!1),t===0?this.element.classList.remove(i("open")):(this.appendChildren(this.config.animateOpen),this.element.classList.add(i("open")))))},e.prototype.getInlinepreview=function(){var t=this;if(this.isArray)return this.json.length>this.config.hoverPreviewArrayCount?"Array[".concat(this.json.length,"]"):"[".concat(this.json.map(j).join(", "),"]");var n=this.keys,r=n.slice(0,this.config.hoverPreviewFieldCount).map(function(o){return"".concat(o,":").concat(j(t.json[o]))}),s=n.length>=this.config.hoverPreviewFieldCount?"\u2026":"";return"{".concat(r.join(", ")).concat(s,"}")},e.prototype.render=function(){this.element=a("div","row");var t=this.isObject?a("a","toggler-link"):a("span");if(this.isObject&&!this.useToJSON&&t.appendChild(a("span","toggler")),this.isArrayRange?t.appendChild(a("span","range","[".concat(this.displayKey,"]"))):this.hasKey&&(t.appendChild(a("span","key","".concat(this.displayKey,":"))),this.config.exposePath&&(this.element.dataset.path=JSON.stringify(this.path))),this.isObject&&!this.useToJSON){var n=a("span","value"),r=a("span");if(!this.isArrayRange){var s=a("span","constructor-name",this.constructorName);r.appendChild(s)}if(this.isArray&&!this.isArrayRange){var o=a("span");o.appendChild(a("span","bracket","[")),o.appendChild(a("span","number",this.json.length)),o.appendChild(a("span","bracket","]")),r.appendChild(o)}n.appendChild(r),t.appendChild(n)}else{(n=this.isUrl?a("a"):a("span")).classList.add(i(this.type)),this.isDate&&n.classList.add(i("date")),this.isUrl&&(n.classList.add(i("url")),n.setAttribute("href",this.json));var l=w(this.type,this.json,this.useToJSON?this.json.toJSON():this.json);n.appendChild(document.createTextNode(l)),t.appendChild(n)}if(this.isObject&&this.config.hoverPreviewEnabled){var c=a("span","preview-text");c.appendChild(document.createTextNode(this.getInlinepreview())),t.appendChild(c)}var f=a("div","children");return this.isObject&&f.classList.add(i("object")),this.isArray&&f.classList.add(i("array")),this.isEmpty&&f.classList.add(i("empty")),this.config&&this.config.theme&&this.element.classList.add(i(this.config.theme)),this.isOpen&&this.element.classList.add(i("open")),this.element.appendChild(t),this.element.appendChild(f),this.isObject&&this.isOpen&&this.appendChildren(),this.isObject&&!this.useToJSON&&t.addEventListener("click",this.toggleOpen.bind(this)),this.element},e.prototype.appendChildren=function(t){var n=this;t===void 0&&(t=!1);var r=this.element.querySelector("div.".concat(i("children")));if(r&&!this.isEmpty){var s=function(c,f){var d=n.isLargeArray?[f*n.config.maxArrayItems,Math.min(n.json.length-1,f*n.config.maxArrayItems+(n.config.maxArrayItems-1))]:void 0,h=n.isArrayRange?(n.arrayRange[0]+f).toString():c,k=new e(d?n.json.slice(d[0],d[1]+1):n.json[c],n.open-1,n.config,c,h,d?n.path:n.path.concat(h),d);r.appendChild(k.render())};if(t){var o=0,l=function(){var c=n.keys[o];s(c,o),(o+=1)<n.keys.length&&(o>10?l():p(l))};p(l)}else this.keys.forEach(function(c,f){return s(c,f)})}},e.prototype.removeChildren=function(t){t===void 0&&(t=!1);var n=this.element.querySelector("div.".concat(i("children")));if(t){var r=0,s=function(){n&&n.children.length&&(n.removeChild(n.children[0]),(r+=1)>10?s():p(s))};p(s)}else n&&(n.innerHTML="")},e}(),v=x;var b=async()=>{let e=null;try{const t=await fetch("/wp-json/wpc2o/v1/stock-sync/",{method:"get",headers:{"Content-Type":"application/json"}});if(e=await t.json(),console.log(e),t.ok)e=await t.json()}catch(t){console.log({err:t}),e={status:!1,message:"There was a problem requesting a stock sync."}}return e};document.querySelectorAll(".wpc2o-expand-details").forEach((e)=>{e?.addEventListener("click",(t)=>{t.preventDefault(),e?.nextElementSibling?.classList.toggle("show")})});document.addEventListener("DOMContentLoaded",function(){document.querySelectorAll(".wpc2o-code-block").forEach((t)=>{const n=t.getElementsByTagName("code")[0],r=new v(JSON.parse(n.innerText),1/0);t.removeChild(n),t.appendChild(r.render())})});document.addEventListener("DOMContentLoaded",()=>{const e=document.getElementById("wpc2o-example-json");if(e)document.getElementById("wpc2o-expand-api-request")?.addEventListener("click",(t)=>{t.preventDefault(),e.classList.toggle("wpc2o-example-show")}),document.getElementById("wpc2o-copy-api-request")?.addEventListener("click",(t)=>{t.preventDefault(),navigator.clipboard.writeText(e.innerText)}),document.getElementById("wpc2o-manual-stock-sync-trigger")?.addEventListener("submit",async(t)=>{t.preventDefault();const n=document.getElementById("wpc2o-manual-stock-sync-trigger-button");if(n)n.disabled=!0;const r=document.createElement("span");r.id="wpc2o-manual-stock-sync-message",r.style.display="block",r.style.marginBottom="16px",r.innerText="Sync in progress... please do NOT close this page.",r.style.color="#3858e9",r.style.fontWeight="500",n?.after(r);const s=document.getElementById("wpc2o-manual-stock-sync-message"),o=await b();if(s&&o){const l=o.status?"green":"red";r.style.color=l,s.innerText=o.message}if(n)n.disabled=!1})});document.addEventListener("DOMContentLoaded",()=>{document.querySelectorAll(".wpc2o-view-order-payload").forEach((e)=>{e?.addEventListener("click",(t)=>{t.preventDefault();const n=e.nextElementSibling;if(n)n.classList.toggle("open")})}),document.querySelectorAll(".wpc2o-view-payload-modal-close").forEach((e)=>{e.addEventListener("click",(t)=>{t.preventDefault(),document.querySelectorAll(".wpc2o-view-payload-modal.open").forEach((n)=>n.classList.toggle("open"))})}),document.querySelectorAll(".wpc2o-view-payload-modal-copy").forEach((e)=>{e.addEventListener("click",(t)=>{t.preventDefault();const n=document.querySelector(".wpc2o-view-payload-modal.open .wpc2o-view-payload-modal-content");if(n)navigator.clipboard.writeText(n.innerText)})})});
