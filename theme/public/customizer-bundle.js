/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./theme/src/customizer.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./theme/src/customizer.js":
/*!*********************************!*\
  !*** ./theme/src/customizer.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("/**\n * File customizer.js.\n *\n * Theme Customizer enhancements for a better user experience.\n *\n * Contains handlers to make Theme Customizer preview reload changes asynchronously.\n */\n(function ($) {\n  // Site title and description.\n  wp.customize('blogname', function (value) {\n    value.bind(function (to) {\n      $('.site-title a').text(to);\n    });\n  });\n  wp.customize('blogdescription', function (value) {\n    value.bind(function (to) {\n      $('.site-description').text(to);\n    });\n  }); // Header text color.\n\n  wp.customize('header_textcolor', function (value) {\n    value.bind(function (to) {\n      if ('blank' === to) {\n        $('.site-title, .site-description').css({\n          clip: 'rect(1px, 1px, 1px, 1px)',\n          position: 'absolute'\n        });\n      } else {\n        $('.site-title, .site-description').css({\n          clip: 'auto',\n          position: 'relative'\n        });\n        $('.site-title a, .site-description').css({\n          color: to\n        });\n      }\n    });\n  });\n})(jQuery);//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi90aGVtZS9zcmMvY3VzdG9taXplci5qcy5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3RoZW1lL3NyYy9jdXN0b21pemVyLmpzP2Q1NzYiXSwic291cmNlc0NvbnRlbnQiOlsiLyoqXG4gKiBGaWxlIGN1c3RvbWl6ZXIuanMuXG4gKlxuICogVGhlbWUgQ3VzdG9taXplciBlbmhhbmNlbWVudHMgZm9yIGEgYmV0dGVyIHVzZXIgZXhwZXJpZW5jZS5cbiAqXG4gKiBDb250YWlucyBoYW5kbGVycyB0byBtYWtlIFRoZW1lIEN1c3RvbWl6ZXIgcHJldmlldyByZWxvYWQgY2hhbmdlcyBhc3luY2hyb25vdXNseS5cbiAqL1xuKGZ1bmN0aW9uICgkKSB7XG4gIC8vIFNpdGUgdGl0bGUgYW5kIGRlc2NyaXB0aW9uLlxuICB3cC5jdXN0b21pemUoJ2Jsb2duYW1lJywgZnVuY3Rpb24gKHZhbHVlKSB7XG4gICAgdmFsdWUuYmluZChmdW5jdGlvbiAodG8pIHtcbiAgICAgICQoJy5zaXRlLXRpdGxlIGEnKS50ZXh0KHRvKTtcbiAgICB9KTtcbiAgfSk7XG4gIHdwLmN1c3RvbWl6ZSgnYmxvZ2Rlc2NyaXB0aW9uJywgZnVuY3Rpb24gKHZhbHVlKSB7XG4gICAgdmFsdWUuYmluZChmdW5jdGlvbiAodG8pIHtcbiAgICAgICQoJy5zaXRlLWRlc2NyaXB0aW9uJykudGV4dCh0byk7XG4gICAgfSk7XG4gIH0pOyAvLyBIZWFkZXIgdGV4dCBjb2xvci5cblxuICB3cC5jdXN0b21pemUoJ2hlYWRlcl90ZXh0Y29sb3InLCBmdW5jdGlvbiAodmFsdWUpIHtcbiAgICB2YWx1ZS5iaW5kKGZ1bmN0aW9uICh0bykge1xuICAgICAgaWYgKCdibGFuaycgPT09IHRvKSB7XG4gICAgICAgICQoJy5zaXRlLXRpdGxlLCAuc2l0ZS1kZXNjcmlwdGlvbicpLmNzcyh7XG4gICAgICAgICAgY2xpcDogJ3JlY3QoMXB4LCAxcHgsIDFweCwgMXB4KScsXG4gICAgICAgICAgcG9zaXRpb246ICdhYnNvbHV0ZSdcbiAgICAgICAgfSk7XG4gICAgICB9IGVsc2Uge1xuICAgICAgICAkKCcuc2l0ZS10aXRsZSwgLnNpdGUtZGVzY3JpcHRpb24nKS5jc3Moe1xuICAgICAgICAgIGNsaXA6ICdhdXRvJyxcbiAgICAgICAgICBwb3NpdGlvbjogJ3JlbGF0aXZlJ1xuICAgICAgICB9KTtcbiAgICAgICAgJCgnLnNpdGUtdGl0bGUgYSwgLnNpdGUtZGVzY3JpcHRpb24nKS5jc3Moe1xuICAgICAgICAgIGNvbG9yOiB0b1xuICAgICAgICB9KTtcbiAgICAgIH1cbiAgICB9KTtcbiAgfSk7XG59KShqUXVlcnkpOyJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./theme/src/customizer.js\n");

/***/ })

/******/ });