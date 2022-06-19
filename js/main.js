/*
 * @Author: Emma Forslund - emfo2102 
 * @Date: 2022-06-19 17:54:17 
 * @Last Modified by: Emma Forslund - emfo2102
 * @Last Modified time: 2022-06-19 17:54:41
 */

"use strict";
//Variables
let hamburger = document.getElementById("hamburger-icon");
let navUl = document.getElementById("nav-ul");
window.onload = init;

function init() {

  //Hamburger-menu
  hamburger.addEventListener("click", () => {
    navUl.classList.toggle("show");
  })
}