const navSvg = Array.from(document.getElementsByClassName('navLinkSvg'));
const navLink = Array.from(document.getElementsByClassName('navLinkSpan'));
const dropDropdown = Array.from(document.getElementsByClassName('dropdownMenu'));

// Ensure that navSvg, navLink, and dropDropdown arrays have the same length or handle accordingly
const length = Math.min(navSvg.length, navLink.length, dropDropdown.length);

for (let i = 0; i < length; i++) {
  const positionDropdown = (index) => {
    const rect = navLink[index].getBoundingClientRect();
    dropDropdown[index].style.left = `${rect.left}px`;
    dropDropdown[index].style.top = `${rect.bottom}px`;
  };

  // Add mouseenter event listener to navLink
  navLink[i].addEventListener("mouseenter", () => {
    navSvg[i].style.transform = "rotate(0deg)";
    dropDropdown[i].style.display = "block"; // assuming you want to show the dropdown
    positionDropdown(i); // position the dropdown under the navLink
  });

  dropDropdown[i].addEventListener("mouseenter", () => {
    navSvg[i].style.transform = "rotate(0deg)";
    dropDropdown[i].style.display = "block"; // assuming you want to show the dropdown
    positionDropdown(i); // position the dropdown under the navLink
  });

  // Add mouseleave event listener to navLink
  navLink[i].addEventListener("mouseleave", () => {
    navSvg[i].style.transform = "rotate(-90deg)";
    dropDropdown[i].style.display = "none"; // assuming you want to hide the dropdown
  });

  // Add mouseleave event listener to dropDropdown
  dropDropdown[i].addEventListener("mouseleave", () => {
    navSvg[i].style.transform = "rotate(-90deg)";
    dropDropdown[i].style.display = "none"; // assuming you want to hide the dropdown
  });
}
