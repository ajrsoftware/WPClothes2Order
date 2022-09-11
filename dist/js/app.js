"use strict";
(self["webpackChunkwpclothes2order"] = self["webpackChunkwpclothes2order"] || []).push([["/dist/js/app"],{

/***/ "./src/ts/app.ts":
/*!***********************!*\
  !*** ./src/ts/app.ts ***!
  \***********************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {



var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};

Object.defineProperty(exports, "__esModule", ({
  value: true
}));

var core_1 = __importDefault(__webpack_require__(/*! highlight.js/lib/core */ "./node_modules/highlight.js/lib/core.js"));

var json_1 = __importDefault(__webpack_require__(/*! highlight.js/lib/languages/json */ "./node_modules/highlight.js/lib/languages/json.js"));

core_1["default"].registerLanguage('json', json_1["default"]);
document.addEventListener('DOMContentLoaded', function () {
  var element = document.getElementById('wpc2o-example-json');
  if (element) core_1["default"].highlightElement(element);
});

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["/dist/js/vendor"], () => (__webpack_exec__("./src/ts/app.ts")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);