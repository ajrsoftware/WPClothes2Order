"use strict";
(self["webpackChunkwpclothes2order"] = self["webpackChunkwpclothes2order"] || []).push([["/dist/js/components"],{

/***/ "./src/components/ProductList.tsx":
/*!****************************************!*\
  !*** ./src/components/ProductList.tsx ***!
  \****************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {



Object.defineProperty(exports, "__esModule", ({
  value: true
}));

var jsx_runtime_1 = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");

var ProductList = function ProductList() {
  return (0, jsx_runtime_1.jsx)("div", {
    children: "Hello"
  });
};

exports["default"] = ProductList;

/***/ }),

/***/ "./src/components/ProductTypeSelector.tsx":
/*!************************************************!*\
  !*** ./src/components/ProductTypeSelector.tsx ***!
  \************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {



function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

var __createBinding = this && this.__createBinding || (Object.create ? function (o, m, k, k2) {
  if (k2 === undefined) k2 = k;
  var desc = Object.getOwnPropertyDescriptor(m, k);

  if (!desc || ("get" in desc ? !m.__esModule : desc.writable || desc.configurable)) {
    desc = {
      enumerable: true,
      get: function get() {
        return m[k];
      }
    };
  }

  Object.defineProperty(o, k2, desc);
} : function (o, m, k, k2) {
  if (k2 === undefined) k2 = k;
  o[k2] = m[k];
});

var __setModuleDefault = this && this.__setModuleDefault || (Object.create ? function (o, v) {
  Object.defineProperty(o, "default", {
    enumerable: true,
    value: v
  });
} : function (o, v) {
  o["default"] = v;
});

var __importStar = this && this.__importStar || function (mod) {
  if (mod && mod.__esModule) return mod;
  var result = {};
  if (mod != null) for (var k in mod) {
    if (k !== "default" && Object.prototype.hasOwnProperty.call(mod, k)) __createBinding(result, mod, k);
  }

  __setModuleDefault(result, mod);

  return result;
};

Object.defineProperty(exports, "__esModule", ({
  value: true
}));

var jsx_runtime_1 = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");

var react_1 = __webpack_require__(/*! react */ "./node_modules/react/index.js");

var D = __importStar(__webpack_require__(/*! ../ts/data */ "./src/ts/data.ts"));

var H = __importStar(__webpack_require__(/*! ../ts/helpers */ "./src/ts/helpers.ts"));

var ProductTypeSelector = function ProductTypeSelector(_ref) {
  var type = _ref.type,
      position = _ref.position,
      width = _ref.width;
  var availableTypes = D.clothingTypes;

  var _ref2 = (0, react_1.useState)(type !== null && type !== void 0 ? type : availableTypes[0]),
      _ref3 = _slicedToArray(_ref2, 2),
      chosenType = _ref3[0],
      setChosenType = _ref3[1];

  return (0, jsx_runtime_1.jsxs)("div", Object.assign({
    className: "product-type-selector"
  }, {
    children: [(0, jsx_runtime_1.jsx)("div", {
      children: (0, jsx_runtime_1.jsxs)("label", Object.assign({
        htmlFor: "_wpc2o_chosen_type",
        className: "selector-label"
      }, {
        children: [(0, jsx_runtime_1.jsxs)("span", Object.assign({
          className: "selector-header"
        }, {
          children: ["Select which ", (0, jsx_runtime_1.jsx)("strong", {
            children: "type"
          }), " of product this is"]
        })), (0, jsx_runtime_1.jsx)("select", Object.assign({
          name: "_wpc2o_chosen_type",
          id: "_wpc2o_chosen_type",
          className: "select short selectProductType",
          disabled: availableTypes.length <= 0,
          onChange: function onChange(event) {
            setChosenType(event.target.value);
          }
        }, {
          children: availableTypes.map(function (type) {
            return (0, jsx_runtime_1.jsx)("option", Object.assign({
              value: type
            }, {
              children: H.camelToText(type)
            }), type);
          })
        }))]
      }))
    }), (0, jsx_runtime_1.jsx)(PositionSelector, {
      initial: position,
      initialWidth: width ? parseInt(width, 10) : undefined,
      type: chosenType
    }, chosenType)]
  }));
};

var PositionSelector = function PositionSelector(_ref4) {
  var initial = _ref4.initial,
      initialWidth = _ref4.initialWidth,
      type = _ref4.type;
  var availablePositions = D.getPositions(type);

  var _ref5 = (0, react_1.useState)(initial !== null && initial !== void 0 ? initial : availablePositions[0]),
      _ref6 = _slicedToArray(_ref5, 2),
      chosenPosition = _ref6[0],
      setChosenPosition = _ref6[1];

  if (chosenPosition) {
    return (0, jsx_runtime_1.jsxs)("div", Object.assign({
      className: "product-position-selector"
    }, {
      children: [(0, jsx_runtime_1.jsxs)("label", Object.assign({
        htmlFor: "_wpc2o_chosen_position",
        className: "selector-label"
      }, {
        children: [(0, jsx_runtime_1.jsxs)("span", Object.assign({
          className: "selector-header"
        }, {
          children: ["Select the ", (0, jsx_runtime_1.jsx)("strong", {
            children: "position"
          }), " of this logo"]
        })), (0, jsx_runtime_1.jsx)("select", Object.assign({
          name: "_wpc2o_chosen_position",
          id: "_wpc2o_chosen_position",
          className: "select short selectProductType",
          disabled: availablePositions.length <= 0,
          onChange: function onChange(event) {
            var selectedOption = document.querySelector("#".concat(event.target.id, "_").concat(event.target.value));

            if (selectedOption) {
              setChosenPosition(selectedOption.dataset.position);
            }
          }
        }, {
          children: availablePositions.map(function (position) {
            var _a, _b, _c;

            return (0, jsx_runtime_1.jsx)("option", Object.assign({
              id: "_wpc2o_chosen_position_".concat((_a = D.Data.clothing[type].positions[position]) === null || _a === void 0 ? void 0 : _a.code),
              value: "".concat((_b = D.Data.clothing[type].positions[position]) === null || _b === void 0 ? void 0 : _b.code),
              "data-position": position
            }, {
              children: "".concat((_c = D.Data.clothing[type].positions[position]) === null || _c === void 0 ? void 0 : _c.label)
            }), position);
          })
        }))]
      })), (0, jsx_runtime_1.jsx)(WidthSelector, {
        initial: initialWidth,
        type: type,
        position: chosenPosition
      }, chosenPosition)]
    }));
  }

  return null;
};

var WidthSelector = function WidthSelector(_ref7) {
  var initial = _ref7.initial,
      type = _ref7.type,
      position = _ref7.position;
  var widths = D.getWidths(type, position);
  var first = widths ? widths[0].toString() : null;

  var _ref8 = (0, react_1.useState)(first),
      _ref9 = _slicedToArray(_ref8, 2),
      selectedWidth = _ref9[0],
      setSelectedWidth = _ref9[1];

  if (widths) {
    return (0, jsx_runtime_1.jsx)(jsx_runtime_1.Fragment, {
      children: (0, jsx_runtime_1.jsx)("div", {
        children: (0, jsx_runtime_1.jsxs)("label", Object.assign({
          htmlFor: "_wpc2o_chosen_width",
          className: "selector-label"
        }, {
          children: [(0, jsx_runtime_1.jsxs)("span", Object.assign({
            className: "selector-header"
          }, {
            children: ["Select the ", (0, jsx_runtime_1.jsx)("strong", {
              children: "width(cm)"
            }), " of this logo"]
          })), (0, jsx_runtime_1.jsx)("select", Object.assign({
            name: "_wpc2o_chosen_width",
            id: "_wpc2o_chosen_width",
            className: "select short",
            defaultValue: initial,
            onChange: function onChange(event) {
              return setSelectedWidth(event.target.value);
            }
          }, {
            children: widths.map(function (width) {
              return (0, jsx_runtime_1.jsxs)("option", Object.assign({
                value: width
              }, {
                children: [width, "cm"]
              }), type + '-' + position + '-' + width);
            })
          }))]
        }))
      })
    });
  }

  return null;
};

exports["default"] = ProductTypeSelector;

/***/ }),

/***/ "./src/ts/components.ts":
/*!******************************!*\
  !*** ./src/ts/components.ts ***!
  \******************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {



var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};

Object.defineProperty(exports, "__esModule", ({
  value: true
}));

var react_1 = __importDefault(__webpack_require__(/*! react */ "./node_modules/react/index.js"));

var react_abode_1 = __webpack_require__(/*! react-abode */ "./node_modules/react-abode/dist/react-abode.esm.js");

var ProductList_1 = __importDefault(__webpack_require__(/*! ../components/ProductList */ "./src/components/ProductList.tsx"));

var ProductTypeSelector_1 = __importDefault(__webpack_require__(/*! ../components/ProductTypeSelector */ "./src/components/ProductTypeSelector.tsx"));

(0, react_abode_1.register)('ProductList', function () {
  return react_1["default"].memo(ProductList_1["default"]);
});
(0, react_abode_1.register)('ProductTypeSelector', function () {
  return react_1["default"].memo(ProductTypeSelector_1["default"]);
}); // Use it, accepts options

(0, react_abode_1.populate)();

/***/ }),

/***/ "./src/ts/data.ts":
/*!************************!*\
  !*** ./src/ts/data.ts ***!
  \************************/
/***/ ((__unused_webpack_module, exports) => {



Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.Data = exports.getWidths = exports.getPositions = exports.clothingTypes = void 0;
exports.clothingTypes = ['top', 'bag', 'bottoms', 'hat', 'teaTowels', 'tie'];

var getPositions = function getPositions(type) {
  return Object.entries(exports.Data.clothing[type].positions).map(function (item) {
    return item[1].id;
  });
};

exports.getPositions = getPositions;

var getWidths = function getWidths(type, position) {
  var _a;

  console.log({
    type: type,
    position: position
  });
  return (_a = exports.Data.clothing[type].positions[position]) === null || _a === void 0 ? void 0 : _a.widths;
};

exports.getWidths = getWidths;
exports.Data = {
  clothing: {
    top: {
      positions: {
        rightSleeve: {
          id: 'rightSleeve',
          label: 'Right sleeve',
          code: 1,
          widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        },
        rightBottom: {
          id: 'rightBottom',
          label: 'Right bottom',
          code: 2,
          widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        },
        rightChest: {
          id: 'rightChest',
          label: 'Right chest',
          code: 3,
          widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        },
        centerChest: {
          id: 'centerChest',
          label: 'Center chest',
          code: 4,
          widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30]
        },
        centerBack: {
          id: 'centerBack',
          label: 'Center back',
          code: 8,
          widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30]
        },
        leftSleeve: {
          id: 'leftSleeve',
          label: 'Left sleeve',
          code: 7,
          widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        },
        leftChest: {
          id: 'leftChest',
          label: 'Left chest',
          code: 5,
          widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        },
        leftBottom: {
          id: 'leftBottom',
          label: 'Left bottom',
          code: 6,
          widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        },
        topBack: {
          id: 'topBack',
          label: 'Top back',
          code: 9,
          widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30]
        },
        bottomBack: {
          id: 'bottomBack',
          label: 'Bottom back',
          code: 12,
          widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30]
        },
        topChest: {
          id: 'topChest',
          label: 'Top chest',
          code: 17,
          widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30]
        },
        insideBack: {
          id: 'insideBack',
          label: 'Inside back (labels)',
          code: 18,
          widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
      }
    },
    bottoms: {
      positions: {
        leftPocket: {
          id: 'leftPocket',
          label: 'Left pocket',
          code: 15,
          widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        },
        rightPocket: {
          id: 'rightPocket',
          label: 'Right pocket',
          code: 16,
          widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
      }
    },
    bag: {
      positions: {
        front: {
          id: 'front',
          label: 'Front',
          code: 13,
          widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30]
        }
      }
    },
    hat: {
      positions: {
        front: {
          id: 'front',
          label: 'Front',
          code: 11,
          widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        }
      }
    },
    teaTowels: {
      positions: {
        center: {
          id: 'center',
          label: 'Center',
          code: 14,
          widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30]
        }
      }
    },
    tie: {
      positions: {
        front: {
          id: 'front',
          label: 'Center',
          code: 19,
          widths: [1, 2, 3, 4, 5]
        }
      }
    }
  }
};

/***/ }),

/***/ "./src/ts/helpers.ts":
/*!***************************!*\
  !*** ./src/ts/helpers.ts ***!
  \***************************/
/***/ ((__unused_webpack_module, exports) => {



Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.camelToText = void 0;

var camelToText = function camelToText(text) {
  var result = text.replace(/([A-Z])/g, ' $1');
  return result.charAt(0).toUpperCase() + result.slice(1);
};

exports.camelToText = camelToText;

/***/ }),

/***/ "./src/css/styles.css":
/*!****************************!*\
  !*** ./src/css/styles.css ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["dist/css/styles","/dist/js/vendor"], () => (__webpack_exec__("./src/ts/components.ts"), __webpack_exec__("./src/css/styles.css")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);