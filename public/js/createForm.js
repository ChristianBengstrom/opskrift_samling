'use strict';

let fire = function () {
  let iGroup = $('iGroup');
  let iGroupCounter = 0;

  let addIgroup = () => {
    iGroupCounter ++;

    // Create inputs
    let br = document.createElement("br");

    let ingrInput = document.createElement("input");
    ingrInput.setAttribute("placeholder", "Ingrediens "+(iGroupCounter+1));
    ingrInput.setAttribute("name", "ingr[]");
    ingrInput.setAttribute("type", "text");

    let qtInput = document.createElement("input");
    qtInput.setAttribute("placeholder", "Mængde "+(iGroupCounter+1));
    qtInput.setAttribute("name", "qt[]");
    qtInput.setAttribute("type", "number");
    qtInput.setAttribute("step", "any");

    let enhedInput = document.createElement("input");
    enhedInput.setAttribute("placeholder", "Enhed "+(iGroupCounter+1));
    enhedInput.setAttribute("name", "enhed[]");
    enhedInput.setAttribute("type", "text");


    // Now append
    iGroup.appendChild(br);
    iGroup.appendChild(ingrInput);
    iGroup.appendChild(qtInput);
    iGroup.appendChild(enhedInput);
  };

  let addBTN = $('add');
  addBTN.addEventListener('click', addIgroup);

}

/*
 * activate theFunction when document has finished loading
 */
window.addEventListener('load', fire);
