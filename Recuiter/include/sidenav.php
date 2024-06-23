<section id="sidebar">
  <a href="index" class="brand">
    <!-- <i class="bx bxs-smile"></i> -->
    <!-- <span class="text">GRADUATEJOB</span> -->
            <!-- <img src="../images/Graduatejob Logo.jpg" class="h-8" alt="company Logo" style="width: 200px; height: 65px; margin-left: 23px; margin-top: 75px;" /> -->
  </a>
  <ul class="side-menu top">
    <li id="dashboard" class="">
      <a href="index">
        <i class="bx bxs-dashboard"></i>
        <span class="text">Dashboard</span>
      </a>
    </li>
    <li id="company_details">
      <a href="company_details">
        <i class="bx bx-building"></i>
        <span class="text">Company Details</span>
      </a>
    </li>
    <li id="addjobs">
      <a href="addjobs">
        <i class="bx bx-plus"></i>
        <span class="text">Add Jobs</span>
      </a>
    </li>
    <li id="job_listing">
      <a href="job_listing">
        <i class="bx  bx-show"></i>
        <span class="text">Views</span>
      </a>
    </li>
    <li id="subscribers">
      <a href="subscribers">
        <i class="bx bx-group"></i>
        <span class="text">Followers</span>
      </a>
    </li>
  </ul>
  <ul class="side-menu">
    <li id="logout">
      <a href="../logout" class="logout">
        <i class="bx bxs-log-out-circle"></i>
        <span class="text">Logout</span>
      </a>
    </li>
  </ul>
</section>



<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Get all sidebar links
    const sidebarLinks = document.querySelectorAll('#sidebar .side-menu li a');

    // Function to remove 'active' class from all items
    function removeActiveClass() {
      sidebarLinks.forEach(link => {
        link.parentElement.classList.remove('active');
      });
    }

    // Function to set the active class based on the current URL
    function setActiveLink() {
      // Get the current URL path
      const path = window.location.pathname.split("/").pop();
      // Loop through links to find the one matching the current path
      sidebarLinks.forEach(link => {
        if (link.getAttribute('href') === path) {
          link.parentElement.classList.add('active');
        }
      });
    }

    // Add click event listener to each link
    sidebarLinks.forEach(link => {
      link.addEventListener('click', function () {
        // Remove 'active' class from all items
        removeActiveClass();
        // Add 'active' class to the parent li of the clicked link
        this.parentElement.classList.add('active');
      });
    });

    // Set the active link based on the current URL when the page loads
    setActiveLink();
  });
</script>



<style>
  .ul {
    padding-left: 0rem;
  }

  .side-menu li.active {
    background-color: #f0f0f0;
    /* Example active background color */
  }

  .side-menu li.active a {
    color: #000;
    /* Example active text color */
  }
</style>