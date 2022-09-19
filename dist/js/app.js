(()=>{var e,n={618:function(e,n,t){"use strict";var i=this&&this.__importDefault||function(e){return e&&e.__esModule?e:{default:e}};Object.defineProperty(n,"__esModule",{value:!0});var o=i(t(390)),r=i(t(14));o.default.registerLanguage("json",r.default),document.querySelectorAll(".wpc2o-expand-details").forEach((function(e){null==e||e.addEventListener("click",(function(n){var t;n.preventDefault(),null===(t=null==e?void 0:e.nextElementSibling)||void 0===t||t.classList.toggle("show")}))})),document.addEventListener("DOMContentLoaded",(function(){var e,n,t,i=document.getElementById("wpc2o-example-json");i&&(o.default.highlightElement(i),null===(e=document.getElementById("wpc2o-expand-api-request"))||void 0===e||e.addEventListener("click",(function(e){e.preventDefault(),i.classList.toggle("wpc2o-example-show")})),null===(n=document.getElementById("wpc2o-copy-api-request"))||void 0===n||n.addEventListener("click",(function(e){e.preventDefault(),navigator.clipboard.writeText(i.innerText)})),null===(t=document.getElementById("wpc2o-manual-stock-sync-trigger"))||void 0===t||t.addEventListener("submit",(function(e){e.preventDefault();var n=document.getElementById("wpc2o-manual-stock-sync-trigger-button");n&&(n.disabled=!0),console.log("Trigger sync")})))}))},517:()=>{},390:e=>{var n={exports:{}};function t(e){return e instanceof Map?e.clear=e.delete=e.set=function(){throw new Error("map is read-only")}:e instanceof Set&&(e.add=e.clear=e.delete=function(){throw new Error("set is read-only")}),Object.freeze(e),Object.getOwnPropertyNames(e).forEach((function(n){var i=e[n];"object"!=typeof i||Object.isFrozen(i)||t(i)})),e}n.exports=t,n.exports.default=t;class i{constructor(e){void 0===e.data&&(e.data={}),this.data=e.data,this.isMatchIgnored=!1}ignoreMatch(){this.isMatchIgnored=!0}}function o(e){return e.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/"/g,"&quot;").replace(/'/g,"&#x27;")}function r(e,...n){const t=Object.create(null);for(const n in e)t[n]=e[n];return n.forEach((function(e){for(const n in e)t[n]=e[n]})),t}const s=e=>!!e.scope||e.sublanguage&&e.language;class a{constructor(e,n){this.buffer="",this.classPrefix=n.classPrefix,e.walk(this)}addText(e){this.buffer+=o(e)}openNode(e){if(!s(e))return;let n="";n=e.sublanguage?`language-${e.language}`:((e,{prefix:n})=>{if(e.includes(".")){const t=e.split(".");return[`${n}${t.shift()}`,...t.map(((e,n)=>`${e}${"_".repeat(n+1)}`))].join(" ")}return`${n}${e}`})(e.scope,{prefix:this.classPrefix}),this.span(n)}closeNode(e){s(e)&&(this.buffer+="</span>")}value(){return this.buffer}span(e){this.buffer+=`<span class="${e}">`}}const c=(e={})=>{const n={children:[]};return Object.assign(n,e),n};class l{constructor(){this.rootNode=c(),this.stack=[this.rootNode]}get top(){return this.stack[this.stack.length-1]}get root(){return this.rootNode}add(e){this.top.children.push(e)}openNode(e){const n=c({scope:e});this.add(n),this.stack.push(n)}closeNode(){if(this.stack.length>1)return this.stack.pop()}closeAllNodes(){for(;this.closeNode(););}toJSON(){return JSON.stringify(this.rootNode,null,4)}walk(e){return this.constructor._walk(e,this.rootNode)}static _walk(e,n){return"string"==typeof n?e.addText(n):n.children&&(e.openNode(n),n.children.forEach((n=>this._walk(e,n))),e.closeNode(n)),e}static _collapse(e){"string"!=typeof e&&e.children&&(e.children.every((e=>"string"==typeof e))?e.children=[e.children.join("")]:e.children.forEach((e=>{l._collapse(e)})))}}class u extends l{constructor(e){super(),this.options=e}addKeyword(e,n){""!==e&&(this.openNode(n),this.addText(e),this.closeNode())}addText(e){""!==e&&this.add(e)}addSublanguage(e,n){const t=e.root;t.sublanguage=!0,t.language=n,this.add(t)}toHTML(){return new a(this,this.options).value()}finalize(){return!0}}function g(e){return e?"string"==typeof e?e:e.source:null}function d(e){return p("(?=",e,")")}function h(e){return p("(?:",e,")*")}function f(e){return p("(?:",e,")?")}function p(...e){return e.map((e=>g(e))).join("")}function b(...e){const n=function(e){const n=e[e.length-1];return"object"==typeof n&&n.constructor===Object?(e.splice(e.length-1,1),n):{}}(e);return"("+(n.capture?"":"?:")+e.map((e=>g(e))).join("|")+")"}function m(e){return new RegExp(e.toString()+"|").exec("").length-1}const E=/\[(?:[^\\\]]|\\.)*\]|\(\??|\\([1-9][0-9]*)|\\./;function w(e,{joinWith:n}){let t=0;return e.map((e=>{t+=1;const n=t;let i=g(e),o="";for(;i.length>0;){const e=E.exec(i);if(!e){o+=i;break}o+=i.substring(0,e.index),i=i.substring(e.index+e[0].length),"\\"===e[0][0]&&e[1]?o+="\\"+String(Number(e[1])+n):(o+=e[0],"("===e[0]&&t++)}return o})).map((e=>`(${e})`)).join(n)}const x="[a-zA-Z]\\w*",y="[a-zA-Z_]\\w*",v="\\b\\d+(\\.\\d+)?",_="(-?)(\\b0[xX][a-fA-F0-9]+|(\\b\\d+(\\.\\d*)?|\\.\\d+)([eE][-+]?\\d+)?)",O="\\b(0b[01]+)",M={begin:"\\\\[\\s\\S]",relevance:0},k={scope:"string",begin:"'",end:"'",illegal:"\\n",contains:[M]},N={scope:"string",begin:'"',end:'"',illegal:"\\n",contains:[M]},S=function(e,n,t={}){const i=r({scope:"comment",begin:e,end:n,contains:[]},t);i.contains.push({scope:"doctag",begin:"[ ]*(?=(TODO|FIXME|NOTE|BUG|OPTIMIZE|HACK|XXX):)",end:/(TODO|FIXME|NOTE|BUG|OPTIMIZE|HACK|XXX):/,excludeBegin:!0,relevance:0});const o=b("I","a","is","so","us","to","at","if","in","it","on",/[A-Za-z]+['](d|ve|re|ll|t|s|n)/,/[A-Za-z]+[-][a-z]+/,/[A-Za-z][a-z]{2,}/);return i.contains.push({begin:p(/[ ]+/,"(",o,/[.]?[:]?([.][ ]|[ ])/,"){3}")}),i},R=S("//","$"),j=S("/\\*","\\*/"),A=S("#","$"),I={scope:"number",begin:v,relevance:0},L={scope:"number",begin:_,relevance:0},T={scope:"number",begin:O,relevance:0},B={begin:/(?=\/[^/\n]*\/)/,contains:[{scope:"regexp",begin:/\//,end:/\/[gimuy]*/,illegal:/\n/,contains:[M,{begin:/\[/,end:/\]/,relevance:0,contains:[M]}]}]},D={scope:"title",begin:x,relevance:0},C={scope:"title",begin:y,relevance:0},P={begin:"\\.\\s*[a-zA-Z_]\\w*",relevance:0};var H=Object.freeze({__proto__:null,MATCH_NOTHING_RE:/\b\B/,IDENT_RE:x,UNDERSCORE_IDENT_RE:y,NUMBER_RE:v,C_NUMBER_RE:_,BINARY_NUMBER_RE:O,RE_STARTERS_RE:"!|!=|!==|%|%=|&|&&|&=|\\*|\\*=|\\+|\\+=|,|-|-=|/=|/|:|;|<<|<<=|<=|<|===|==|=|>>>=|>>=|>=|>>>|>>|>|\\?|\\[|\\{|\\(|\\^|\\^=|\\||\\|=|\\|\\||~",SHEBANG:(e={})=>{const n=/^#![ ]*\//;return e.binary&&(e.begin=p(n,/.*\b/,e.binary,/\b.*/)),r({scope:"meta",begin:n,end:/$/,relevance:0,"on:begin":(e,n)=>{0!==e.index&&n.ignoreMatch()}},e)},BACKSLASH_ESCAPE:M,APOS_STRING_MODE:k,QUOTE_STRING_MODE:N,PHRASAL_WORDS_MODE:{begin:/\b(a|an|the|are|I'm|isn't|don't|doesn't|won't|but|just|should|pretty|simply|enough|gonna|going|wtf|so|such|will|you|your|they|like|more)\b/},COMMENT:S,C_LINE_COMMENT_MODE:R,C_BLOCK_COMMENT_MODE:j,HASH_COMMENT_MODE:A,NUMBER_MODE:I,C_NUMBER_MODE:L,BINARY_NUMBER_MODE:T,REGEXP_MODE:B,TITLE_MODE:D,UNDERSCORE_TITLE_MODE:C,METHOD_GUARD:P,END_SAME_AS_BEGIN:function(e){return Object.assign(e,{"on:begin":(e,n)=>{n.data._beginMatch=e[1]},"on:end":(e,n)=>{n.data._beginMatch!==e[1]&&n.ignoreMatch()}})}});function $(e,n){"."===e.input[e.index-1]&&n.ignoreMatch()}function U(e,n){void 0!==e.className&&(e.scope=e.className,delete e.className)}function K(e,n){n&&e.beginKeywords&&(e.begin="\\b("+e.beginKeywords.split(" ").join("|")+")(?!\\.)(?=\\b|\\s)",e.__beforeBegin=$,e.keywords=e.keywords||e.beginKeywords,delete e.beginKeywords,void 0===e.relevance&&(e.relevance=0))}function z(e,n){Array.isArray(e.illegal)&&(e.illegal=b(...e.illegal))}function W(e,n){if(e.match){if(e.begin||e.end)throw new Error("begin & end are not supported with match");e.begin=e.match,delete e.match}}function G(e,n){void 0===e.relevance&&(e.relevance=1)}const X=(e,n)=>{if(!e.beforeMatch)return;if(e.starts)throw new Error("beforeMatch cannot be used with starts");const t=Object.assign({},e);Object.keys(e).forEach((n=>{delete e[n]})),e.keywords=t.keywords,e.begin=p(t.beforeMatch,d(t.begin)),e.starts={relevance:0,contains:[Object.assign(t,{endsParent:!0})]},e.relevance=0,delete t.beforeMatch},Z=["of","and","for","in","not","or","if","then","parent","list","value"];function F(e,n,t="keyword"){const i=Object.create(null);return"string"==typeof e?o(t,e.split(" ")):Array.isArray(e)?o(t,e):Object.keys(e).forEach((function(t){Object.assign(i,F(e[t],n,t))})),i;function o(e,t){n&&(t=t.map((e=>e.toLowerCase()))),t.forEach((function(n){const t=n.split("|");i[t[0]]=[e,q(t[0],t[1])]}))}}function q(e,n){return n?Number(n):function(e){return Z.includes(e.toLowerCase())}(e)?0:1}const J={},V=e=>{console.error(e)},Q=(e,...n)=>{console.log(`WARN: ${e}`,...n)},Y=(e,n)=>{J[`${e}/${n}`]||(console.log(`Deprecated as of ${e}. ${n}`),J[`${e}/${n}`]=!0)},ee=new Error;function ne(e,n,{key:t}){let i=0;const o=e[t],r={},s={};for(let e=1;e<=n.length;e++)s[e+i]=o[e],r[e+i]=!0,i+=m(n[e-1]);e[t]=s,e[t]._emit=r,e[t]._multi=!0}function te(e){!function(e){e.scope&&"object"==typeof e.scope&&null!==e.scope&&(e.beginScope=e.scope,delete e.scope)}(e),"string"==typeof e.beginScope&&(e.beginScope={_wrap:e.beginScope}),"string"==typeof e.endScope&&(e.endScope={_wrap:e.endScope}),function(e){if(Array.isArray(e.begin)){if(e.skip||e.excludeBegin||e.returnBegin)throw V("skip, excludeBegin, returnBegin not compatible with beginScope: {}"),ee;if("object"!=typeof e.beginScope||null===e.beginScope)throw V("beginScope must be object"),ee;ne(e,e.begin,{key:"beginScope"}),e.begin=w(e.begin,{joinWith:""})}}(e),function(e){if(Array.isArray(e.end)){if(e.skip||e.excludeEnd||e.returnEnd)throw V("skip, excludeEnd, returnEnd not compatible with endScope: {}"),ee;if("object"!=typeof e.endScope||null===e.endScope)throw V("endScope must be object"),ee;ne(e,e.end,{key:"endScope"}),e.end=w(e.end,{joinWith:""})}}(e)}function ie(e){function n(n,t){return new RegExp(g(n),"m"+(e.case_insensitive?"i":"")+(e.unicodeRegex?"u":"")+(t?"g":""))}class t{constructor(){this.matchIndexes={},this.regexes=[],this.matchAt=1,this.position=0}addRule(e,n){n.position=this.position++,this.matchIndexes[this.matchAt]=n,this.regexes.push([n,e]),this.matchAt+=m(e)+1}compile(){0===this.regexes.length&&(this.exec=()=>null);const e=this.regexes.map((e=>e[1]));this.matcherRe=n(w(e,{joinWith:"|"}),!0),this.lastIndex=0}exec(e){this.matcherRe.lastIndex=this.lastIndex;const n=this.matcherRe.exec(e);if(!n)return null;const t=n.findIndex(((e,n)=>n>0&&void 0!==e)),i=this.matchIndexes[t];return n.splice(0,t),Object.assign(n,i)}}class i{constructor(){this.rules=[],this.multiRegexes=[],this.count=0,this.lastIndex=0,this.regexIndex=0}getMatcher(e){if(this.multiRegexes[e])return this.multiRegexes[e];const n=new t;return this.rules.slice(e).forEach((([e,t])=>n.addRule(e,t))),n.compile(),this.multiRegexes[e]=n,n}resumingScanAtSamePosition(){return 0!==this.regexIndex}considerAll(){this.regexIndex=0}addRule(e,n){this.rules.push([e,n]),"begin"===n.type&&this.count++}exec(e){const n=this.getMatcher(this.regexIndex);n.lastIndex=this.lastIndex;let t=n.exec(e);if(this.resumingScanAtSamePosition())if(t&&t.index===this.lastIndex);else{const n=this.getMatcher(0);n.lastIndex=this.lastIndex+1,t=n.exec(e)}return t&&(this.regexIndex+=t.position+1,this.regexIndex===this.count&&this.considerAll()),t}}if(e.compilerExtensions||(e.compilerExtensions=[]),e.contains&&e.contains.includes("self"))throw new Error("ERR: contains `self` is not supported at the top-level of a language.  See documentation.");return e.classNameAliases=r(e.classNameAliases||{}),function t(o,s){const a=o;if(o.isCompiled)return a;[U,W,te,X].forEach((e=>e(o,s))),e.compilerExtensions.forEach((e=>e(o,s))),o.__beforeBegin=null,[K,z,G].forEach((e=>e(o,s))),o.isCompiled=!0;let c=null;return"object"==typeof o.keywords&&o.keywords.$pattern&&(o.keywords=Object.assign({},o.keywords),c=o.keywords.$pattern,delete o.keywords.$pattern),c=c||/\w+/,o.keywords&&(o.keywords=F(o.keywords,e.case_insensitive)),a.keywordPatternRe=n(c,!0),s&&(o.begin||(o.begin=/\B|\b/),a.beginRe=n(a.begin),o.end||o.endsWithParent||(o.end=/\B|\b/),o.end&&(a.endRe=n(a.end)),a.terminatorEnd=g(a.end)||"",o.endsWithParent&&s.terminatorEnd&&(a.terminatorEnd+=(o.end?"|":"")+s.terminatorEnd)),o.illegal&&(a.illegalRe=n(o.illegal)),o.contains||(o.contains=[]),o.contains=[].concat(...o.contains.map((function(e){return function(e){e.variants&&!e.cachedVariants&&(e.cachedVariants=e.variants.map((function(n){return r(e,{variants:null},n)})));if(e.cachedVariants)return e.cachedVariants;if(oe(e))return r(e,{starts:e.starts?r(e.starts):null});if(Object.isFrozen(e))return r(e);return e}("self"===e?o:e)}))),o.contains.forEach((function(e){t(e,a)})),o.starts&&t(o.starts,s),a.matcher=function(e){const n=new i;return e.contains.forEach((e=>n.addRule(e.begin,{rule:e,type:"begin"}))),e.terminatorEnd&&n.addRule(e.terminatorEnd,{type:"end"}),e.illegal&&n.addRule(e.illegal,{type:"illegal"}),n}(a),a}(e)}function oe(e){return!!e&&(e.endsWithParent||oe(e.starts))}class re extends Error{constructor(e,n){super(e),this.name="HTMLInjectionError",this.html=n}}const se=o,ae=r,ce=Symbol("nomatch");var le=function(e){const t=Object.create(null),o=Object.create(null),r=[];let s=!0;const a="Could not find the language '{}', did you forget to load/include a language module?",c={disableAutodetect:!0,name:"Plain text",contains:[]};let l={ignoreUnescapedHTML:!1,throwUnescapedHTML:!1,noHighlightRe:/^(no-?highlight)$/i,languageDetectRe:/\blang(?:uage)?-([\w-]+)\b/i,classPrefix:"hljs-",cssSelector:"pre code",languages:null,__emitter:u};function g(e){return l.noHighlightRe.test(e)}function m(e,n,t){let i="",o="";"object"==typeof n?(i=e,t=n.ignoreIllegals,o=n.language):(Y("10.7.0","highlight(lang, code, ...args) has been deprecated."),Y("10.7.0","Please use highlight(code, options) instead.\nhttps://github.com/highlightjs/highlight.js/issues/2277"),o=e,i=n),void 0===t&&(t=!0);const r={code:i,language:o};k("before:highlight",r);const s=r.result?r.result:E(r.language,r.code,t);return s.code=r.code,k("after:highlight",s),s}function E(e,n,o,r){const c=Object.create(null);function u(){if(!M.keywords)return void N.addText(S);let e=0;M.keywordPatternRe.lastIndex=0;let n=M.keywordPatternRe.exec(S),t="";for(;n;){t+=S.substring(e,n.index);const o=y.case_insensitive?n[0].toLowerCase():n[0],r=(i=o,M.keywords[i]);if(r){const[e,i]=r;if(N.addText(t),t="",c[o]=(c[o]||0)+1,c[o]<=7&&(R+=i),e.startsWith("_"))t+=n[0];else{const t=y.classNameAliases[e]||e;N.addKeyword(n[0],t)}}else t+=n[0];e=M.keywordPatternRe.lastIndex,n=M.keywordPatternRe.exec(S)}var i;t+=S.substring(e),N.addText(t)}function g(){null!=M.subLanguage?function(){if(""===S)return;let e=null;if("string"==typeof M.subLanguage){if(!t[M.subLanguage])return void N.addText(S);e=E(M.subLanguage,S,!0,k[M.subLanguage]),k[M.subLanguage]=e._top}else e=w(S,M.subLanguage.length?M.subLanguage:null);M.relevance>0&&(R+=e.relevance),N.addSublanguage(e._emitter,e.language)}():u(),S=""}function d(e,n){let t=1;const i=n.length-1;for(;t<=i;){if(!e._emit[t]){t++;continue}const i=y.classNameAliases[e[t]]||e[t],o=n[t];i?N.addKeyword(o,i):(S=o,u(),S=""),t++}}function h(e,n){return e.scope&&"string"==typeof e.scope&&N.openNode(y.classNameAliases[e.scope]||e.scope),e.beginScope&&(e.beginScope._wrap?(N.addKeyword(S,y.classNameAliases[e.beginScope._wrap]||e.beginScope._wrap),S=""):e.beginScope._multi&&(d(e.beginScope,n),S="")),M=Object.create(e,{parent:{value:M}}),M}function f(e,n,t){let o=function(e,n){const t=e&&e.exec(n);return t&&0===t.index}(e.endRe,t);if(o){if(e["on:end"]){const t=new i(e);e["on:end"](n,t),t.isMatchIgnored&&(o=!1)}if(o){for(;e.endsParent&&e.parent;)e=e.parent;return e}}if(e.endsWithParent)return f(e.parent,n,t)}function p(e){return 0===M.matcher.regexIndex?(S+=e[0],1):(I=!0,0)}function b(e){const t=e[0],i=n.substring(e.index),o=f(M,e,i);if(!o)return ce;const r=M;M.endScope&&M.endScope._wrap?(g(),N.addKeyword(t,M.endScope._wrap)):M.endScope&&M.endScope._multi?(g(),d(M.endScope,e)):r.skip?S+=t:(r.returnEnd||r.excludeEnd||(S+=t),g(),r.excludeEnd&&(S=t));do{M.scope&&N.closeNode(),M.skip||M.subLanguage||(R+=M.relevance),M=M.parent}while(M!==o.parent);return o.starts&&h(o.starts,e),r.returnEnd?0:t.length}let m={};function x(t,r){const a=r&&r[0];if(S+=t,null==a)return g(),0;if("begin"===m.type&&"end"===r.type&&m.index===r.index&&""===a){if(S+=n.slice(r.index,r.index+1),!s){const n=new Error(`0 width match regex (${e})`);throw n.languageName=e,n.badRule=m.rule,n}return 1}if(m=r,"begin"===r.type)return function(e){const n=e[0],t=e.rule,o=new i(t),r=[t.__beforeBegin,t["on:begin"]];for(const t of r)if(t&&(t(e,o),o.isMatchIgnored))return p(n);return t.skip?S+=n:(t.excludeBegin&&(S+=n),g(),t.returnBegin||t.excludeBegin||(S=n)),h(t,e),t.returnBegin?0:n.length}(r);if("illegal"===r.type&&!o){const e=new Error('Illegal lexeme "'+a+'" for mode "'+(M.scope||"<unnamed>")+'"');throw e.mode=M,e}if("end"===r.type){const e=b(r);if(e!==ce)return e}if("illegal"===r.type&&""===a)return 1;if(A>1e5&&A>3*r.index){throw new Error("potential infinite loop, way more iterations than matches")}return S+=a,a.length}const y=_(e);if(!y)throw V(a.replace("{}",e)),new Error('Unknown language: "'+e+'"');const v=ie(y);let O="",M=r||v;const k={},N=new l.__emitter(l);!function(){const e=[];for(let n=M;n!==y;n=n.parent)n.scope&&e.unshift(n.scope);e.forEach((e=>N.openNode(e)))}();let S="",R=0,j=0,A=0,I=!1;try{for(M.matcher.considerAll();;){A++,I?I=!1:M.matcher.considerAll(),M.matcher.lastIndex=j;const e=M.matcher.exec(n);if(!e)break;const t=x(n.substring(j,e.index),e);j=e.index+t}return x(n.substring(j)),N.closeAllNodes(),N.finalize(),O=N.toHTML(),{language:e,value:O,relevance:R,illegal:!1,_emitter:N,_top:M}}catch(t){if(t.message&&t.message.includes("Illegal"))return{language:e,value:se(n),illegal:!0,relevance:0,_illegalBy:{message:t.message,index:j,context:n.slice(j-100,j+100),mode:t.mode,resultSoFar:O},_emitter:N};if(s)return{language:e,value:se(n),illegal:!1,relevance:0,errorRaised:t,_emitter:N,_top:M};throw t}}function w(e,n){n=n||l.languages||Object.keys(t);const i=function(e){const n={value:se(e),illegal:!1,relevance:0,_top:c,_emitter:new l.__emitter(l)};return n._emitter.addText(e),n}(e),o=n.filter(_).filter(M).map((n=>E(n,e,!1)));o.unshift(i);const r=o.sort(((e,n)=>{if(e.relevance!==n.relevance)return n.relevance-e.relevance;if(e.language&&n.language){if(_(e.language).supersetOf===n.language)return 1;if(_(n.language).supersetOf===e.language)return-1}return 0})),[s,a]=r,u=s;return u.secondBest=a,u}function x(e){let n=null;const t=function(e){let n=e.className+" ";n+=e.parentNode?e.parentNode.className:"";const t=l.languageDetectRe.exec(n);if(t){const n=_(t[1]);return n||(Q(a.replace("{}",t[1])),Q("Falling back to no-highlight mode for this block.",e)),n?t[1]:"no-highlight"}return n.split(/\s+/).find((e=>g(e)||_(e)))}(e);if(g(t))return;if(k("before:highlightElement",{el:e,language:t}),e.children.length>0&&(l.ignoreUnescapedHTML||(console.warn("One of your code blocks includes unescaped HTML. This is a potentially serious security risk."),console.warn("https://github.com/highlightjs/highlight.js/wiki/security"),console.warn("The element with unescaped HTML:"),console.warn(e)),l.throwUnescapedHTML)){throw new re("One of your code blocks includes unescaped HTML.",e.innerHTML)}n=e;const i=n.textContent,r=t?m(i,{language:t,ignoreIllegals:!0}):w(i);e.innerHTML=r.value,function(e,n,t){const i=n&&o[n]||t;e.classList.add("hljs"),e.classList.add(`language-${i}`)}(e,t,r.language),e.result={language:r.language,re:r.relevance,relevance:r.relevance},r.secondBest&&(e.secondBest={language:r.secondBest.language,relevance:r.secondBest.relevance}),k("after:highlightElement",{el:e,result:r,text:i})}let y=!1;function v(){if("loading"===document.readyState)return void(y=!0);document.querySelectorAll(l.cssSelector).forEach(x)}function _(e){return e=(e||"").toLowerCase(),t[e]||t[o[e]]}function O(e,{languageName:n}){"string"==typeof e&&(e=[e]),e.forEach((e=>{o[e.toLowerCase()]=n}))}function M(e){const n=_(e);return n&&!n.disableAutodetect}function k(e,n){const t=e;r.forEach((function(e){e[t]&&e[t](n)}))}"undefined"!=typeof window&&window.addEventListener&&window.addEventListener("DOMContentLoaded",(function(){y&&v()}),!1),Object.assign(e,{highlight:m,highlightAuto:w,highlightAll:v,highlightElement:x,highlightBlock:function(e){return Y("10.7.0","highlightBlock will be removed entirely in v12.0"),Y("10.7.0","Please use highlightElement now."),x(e)},configure:function(e){l=ae(l,e)},initHighlighting:()=>{v(),Y("10.6.0","initHighlighting() deprecated.  Use highlightAll() now.")},initHighlightingOnLoad:function(){v(),Y("10.6.0","initHighlightingOnLoad() deprecated.  Use highlightAll() now.")},registerLanguage:function(n,i){let o=null;try{o=i(e)}catch(e){if(V("Language definition for '{}' could not be registered.".replace("{}",n)),!s)throw e;V(e),o=c}o.name||(o.name=n),t[n]=o,o.rawDefinition=i.bind(null,e),o.aliases&&O(o.aliases,{languageName:n})},unregisterLanguage:function(e){delete t[e];for(const n of Object.keys(o))o[n]===e&&delete o[n]},listLanguages:function(){return Object.keys(t)},getLanguage:_,registerAliases:O,autoDetection:M,inherit:ae,addPlugin:function(e){!function(e){e["before:highlightBlock"]&&!e["before:highlightElement"]&&(e["before:highlightElement"]=n=>{e["before:highlightBlock"](Object.assign({block:n.el},n))}),e["after:highlightBlock"]&&!e["after:highlightElement"]&&(e["after:highlightElement"]=n=>{e["after:highlightBlock"](Object.assign({block:n.el},n))})}(e),r.push(e)}}),e.debugMode=function(){s=!1},e.safeMode=function(){s=!0},e.versionString="11.6.0",e.regex={concat:p,lookahead:d,either:b,optional:f,anyNumberOfTimes:h};for(const e in H)"object"==typeof H[e]&&n.exports(H[e]);return Object.assign(e,H),e}({});e.exports=le,le.HighlightJS=le,le.default=le},14:e=>{e.exports=function(e){const n=["true","false","null"],t={scope:"literal",beginKeywords:n.join(" ")};return{name:"JSON",keywords:{literal:n},contains:[{className:"attr",begin:/"(\\.|[^\\"\r\n])*"(?=\s*:)/,relevance:1.01},{match:/[{}[\],:]/,className:"punctuation",relevance:0},e.QUOTE_STRING_MODE,t,e.C_NUMBER_MODE,e.C_LINE_COMMENT_MODE,e.C_BLOCK_COMMENT_MODE],illegal:"\\S"}}}},t={};function i(e){var o=t[e];if(void 0!==o)return o.exports;var r=t[e]={exports:{}};return n[e].call(r.exports,r,r.exports,i),r.exports}i.m=n,e=[],i.O=(n,t,o,r)=>{if(!t){var s=1/0;for(u=0;u<e.length;u++){for(var[t,o,r]=e[u],a=!0,c=0;c<t.length;c++)(!1&r||s>=r)&&Object.keys(i.O).every((e=>i.O[e](t[c])))?t.splice(c--,1):(a=!1,r<s&&(s=r));if(a){e.splice(u--,1);var l=o();void 0!==l&&(n=l)}}return n}r=r||0;for(var u=e.length;u>0&&e[u-1][2]>r;u--)e[u]=e[u-1];e[u]=[t,o,r]},i.o=(e,n)=>Object.prototype.hasOwnProperty.call(e,n),(()=>{var e={0:0,311:0};i.O.j=n=>0===e[n];var n=(n,t)=>{var o,r,[s,a,c]=t,l=0;if(s.some((n=>0!==e[n]))){for(o in a)i.o(a,o)&&(i.m[o]=a[o]);if(c)var u=c(i)}for(n&&n(t);l<s.length;l++)r=s[l],i.o(e,r)&&e[r]&&e[r][0](),e[r]=0;return i.O(u)},t=self.webpackChunkwpclothes2order=self.webpackChunkwpclothes2order||[];t.forEach(n.bind(null,0)),t.push=n.bind(null,t.push.bind(t))})(),i.O(void 0,[311],(()=>i(618)));var o=i.O(void 0,[311],(()=>i(517)));o=i.O(o)})();