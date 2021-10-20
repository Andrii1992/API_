$(document).ready(function () {
  $("#imgInpB").change(function () {

    if (!($('#topic').length > 0 && $('#topic').val() != '')) {
      $("#img-load-id").removeClass("d-none");
      let model;
      async function init() {
        const modelURL = "/tensor/image-model/model.json";
        const modelMetaDataURL = "/tensor/image-model/metadata.json";
        model = await tmImage.load(modelURL, modelMetaDataURL);
      }

      init().then(() => {
        console.log('model initialized');
        precict();
      });

      async function precict() {
        let img = document.getElementById('imgInpShowBig');

        const prediction = await model.predict(img);
        var info = getMaxIndex(prediction);
        $('#topic').val(prediction[info[0]].className);
        console.log('Rozpoznawanie zakończone');
        $("#img-load-id").addClass("d-none");
      }

      function getMaxIndex(array) {
        var element = [];
        for (let index = 0; index < array.length; index++) {
          element.push(parseFloat(array[index].probability.toFixed(5)));
        }
        let max = Math.max.apply(Math, element);
        return [element.indexOf(max), max];
      }
    }
  });
});