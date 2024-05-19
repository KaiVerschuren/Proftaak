const navSvg = Array.from(document.getElementsByClassName('navLinkSvg'));
const navLink = Array.from(document.getElementsByClassName('navLinkSpan'));
const dropDropdown = Array.from(document.getElementsByClassName('dropdownMenu'));

for (let i = 0; i < navLink.length; i++) {
  navLink[i] || dropDropdown[i].addEventListener("mouseenter", () => {
    navSvg[i].style.transform = "rotate(0deg)";
    dropDropdown[i].style.display = "absolute";
  });

  navLink[i].addEventListener("mouseleave", () => {
    navSvg[i].style.transform = "rotate(-90deg)";
  });
}
