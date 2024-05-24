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

<<<<<<< Updated upstream
=======
  // Function to handle showing the dropdown
  const showDropdown = (index) => {
    if (timeoutIds[index]) {
      clearTimeout(timeoutIds[index]);
      timeoutIds[index] = null;
    }
    navSvg[index].style.transform = "rotate(0deg)";
    dropDropdown[index].style.display = "block";
    positionDropdown(index);
  };

  // Function to handle hiding the dropdown
  const hideDropdown = (index) => {
    timeoutIds[index] = setTimeout(() => {
      navSvg[index].style.transform = "rotate(-90deg)";
      dropDropdown[index].style.display = "none";
      timeoutIds[index] = null;
    }, 100); // Delay of 1 second
  };

>>>>>>> Stashed changes
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
