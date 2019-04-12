'use strict';

let ignite = function () {
  let persons = $('qtPerson');
  let qtElArr = $c('qt');

  let qtValArr = [];
  for(let item of qtElArr) {
    qtValArr.push(item.childNodes[0].nodeValue);
  };

  let calcPortion = (count) => {

    return qtValArr[count] * persons.value;
  }

  let updatePortion = () => {
    var count = 0;
    for(let item of qtElArr) {
      var oldValue = parseInt(item.childNodes[0].nodeValue);
      var newValue = calcPortion(count);
      item.childNodes[0].nodeValue = newValue             //.toFixed(1);
      count++;
    };
  };

  updatePortion();
  persons.addEventListener('change', updatePortion, false);
};

/*
 * activate theFunction when document has finished loading
 */
window.addEventListener('load', ignite);
