  


function b64toBlob(b64Data, contentType, sliceSize) {
                contentType = contentType || '';
                sliceSize = sliceSize || 512;

                var byteCharacters = atob(b64Data);
                var byteArrays = [];

                for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
                    var slice = byteCharacters.slice(offset, offset + sliceSize);

                    var byteNumbers = new Array(slice.length);
                    for (var i = 0; i < slice.length; i++) {
                        byteNumbers[i] = slice.charCodeAt(i);
                    }

                    var byteArray = new Uint8Array(byteNumbers);

                    byteArrays.push(byteArray);
                }

              var blob = new Blob(byteArrays, {type: contentType});
              return blob;
            }


!function(e,r){"object"==typeof exports&&"undefined"!=typeof module?r(require("jquery"),require("cropperjs")):"function"==typeof define&&define.amd?define(["jquery","cropperjs"],r):r(e.jQuery,e.Cropper)}(this,function(c,s){"use strict";if(c=c&&c.hasOwnProperty("default")?c.default:c,s=s&&s.hasOwnProperty("default")?s.default:s,c.fn){var e=c.fn.cropper,d="cropper";c.fn.cropper=function(p){for(var e=arguments.length,a=Array(1<e?e-1:0),r=1;r<e;r++)a[r-1]=arguments[r];var u=void 0;return this.each(function(e,r){var t=c(r),n="destroy"===p,o=t.data(d);if(!o){if(n)return;var f=c.extend({},t.data(),c.isPlainObject(p)&&p);o=new s(r,f),t.data(d,o)}if("string"==typeof p){var i=o[p];c.isFunction(i)&&((u=i.apply(o,a))===o&&(u=void 0),n&&t.removeData(d))}}),void 0!==u?u:this},c.fn.cropper.Constructor=s,c.fn.cropper.setDefaults=s.setDefaults,c.fn.cropper.noConflict=function(){return c.fn.cropper=e,this}}});


let $cropperCanvasImage;
let ICropper = (function ($) {
    $cropperCanvasImage = $('#cropper-canvas-image');
    return {
        readUrl,
        //cropImage
    }


    function readUrl(input) {
        $cropperCanvasImage.cropper("destroy");
        if (input.files && input.files[0]) {

            let reader = new FileReader();
            reader.onload = function (e) {
                //console.log(e.target.result);
                $cropperCanvasImage.attr('src', e.target.result);
                // $(".cropper-hide").attr('src', e.target.result);
                // $(".cropper-view-box img").attr("src", e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
            setTimeout(initCropper, 1000);
        }
    }

    function initCropper() {
        $cropperCanvasImage.cropper({
            aspectRatio: 3/4,
        });

    }

    /* function cropImage() {
    let imgUrl = $cropperCanvasImage.data('cropper').getCroppedCanvas().toDataURL();
    let img = document.createElement("img");
    img.src = imgUrl;
    $("#cropped-result").append(img);
    } */

})(jQuery)


