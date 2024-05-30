<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if(isset($_SESSION['email'])){
    }else header("Location: index");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <script src="app.js"></script>
    <link rel="shortcut icon" href="public/favicon.png" type="png" />
    <title>Welcome, <?php echo htmlspecialchars(ucfirst($_SESSION['name']), ENT_QUOTES, 'UTF-8') ?></title>
    <style>
      #sidebar-button-history{
        background-color: rgba(57, 108, 205, 0.1);
      }
      #sidebar-button-history div{
        color: #396CCD;
      }
      #sidebar-button-history svg path{
        stroke: #396ccd;
        stroke-opacity: none;
      }
    </style>
  </head>
  <body>
      <?php
        include("components/sidebar.php");
      ?>
      <div class="home-content">
        <div id="home-navbar">
          <div id="home-title">Projects</div>
        </div>
        <div class="page-content">
          <div id="history-subtitle">View your account's projects and images.</div>
          <div id="header-history-table">
            <div id="left-header-table">
              Your Projects
            </div>
            <div>
              <button id="add-button-home" onclick="addpopup();">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                  <path d="M10.0001 4.16663V15.8333M4.16675 9.99996H15.8334" stroke="white" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Add Project
              </button>
              </div>
          </div>
          <div id="filter-bar">
            <div id="filter-button-group">
              <button id="filter-right-button">View All</button>
              <button id="filter-left-button">Finished</button>
            </div>
            <img src="public/search_filter.svg" id="img_search">
            <img src="public/filter-svg.svg" id="filter-svg">
            <div id="filter-right">
              <input type="text" id="filter-search" placeholder="Search">
              <button id="filter-filter-button">Filters</button>
            </div>
          </div>
          <div id="history-second-table-header">
            <div class="center_flex">
              <button></button>
              <div>Project Name</div>
              <div class="center_flex" id="svg-second-table-header">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M7.99992 3.33337V12.6667M7.99992 12.6667L12.6666 8.00004M7.99992 12.6667L3.33325 8.00004" stroke="#475467" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
            </div>
            <div class="center_flex" id="table-categories">
              <div>Status</div>
              <div>Creation Date</div>
              <div>Creator</div>
            </div>
          </div>
        </div>
        <?php
              $stmt = $conn->prepare("SELECT project.name as nome_project, project.id,project.description,state.name, project.creationDate FROM `project`INNER JOIN user on user.Id=project.IdUser inner join state on project.idstate=state.id WHERE user.id = ? ORDER by (project.id) DESC;" );
              $stmt->bind_param('i',$_SESSION['id']);
              $stmt->execute();
              $result = $stmt->get_result();
              
              for ($i = 0; $i < 6; $i++) {
                // Fetch data from the database
                $row = $result->fetch_assoc();
            
                // Check if there is data available
                if ($row) {
                echo '
                <div class="table-record" id="history-table-record">
                  <div class="center_flex">
                    <button></button>
                    <img src="public/svg_table.svg">
                  </div>
                  <div class="container-record-title">
                  <a href="aipredict?id='.$row["id"].'" class="record-title">'.htmlspecialchars($row["nome_project"], ENT_QUOTES, 'UTF-8').'</a>
                    <div class="record-subtitle">'.htmlspecialchars($row["description"], ENT_QUOTES, 'UTF-8').'</div>
                  </div>
                  <div class="status-record">
                    <div class="finished-status center_flex">
                      <img src="public/'.htmlspecialchars($row["name"], ENT_QUOTES, 'UTF-8').'.svg">
                    </div>
                  </div>
                  <div class="creationdate-record">
                    <div class="date-record">'.$row["creationDate"].'</div>
                  </div>
                  <div class="creator-record center_flex">
                      <img src="public/Icon Profile.png" width="32px" height="32px" alt="">
                      <div>'.htmlspecialchars(ucfirst($_SESSION['name']), ENT_QUOTES, 'UTF-8').'</div>
                  </div>
                  <div class="options-record center_flex">
                    <a href="delete?id='.$row["id"].'" onclick="deletepopup(this)">
                      <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5 15H14.1667M14.1667 15H27.5M14.1667 15V26.6666C14.1667 27.1087 14.3423 27.5326 14.6548 27.8451C14.9674 28.1577 15.3913 28.3333 15.8333 28.3333H24.1667C24.6087 28.3333 25.0326 28.1577 25.3452 27.8451C25.6577 27.5326 25.8333 27.1087 25.8333 26.6666V15H14.1667ZM16.6667 15V13.3333C16.6667 12.8913 16.8423 12.4673 17.1548 12.1548C17.4674 11.8422 17.8913 11.6666 18.3333 11.6666H21.6667C22.1087 11.6666 22.5326 11.8422 22.8452 12.1548C23.1577 12.4673 23.3333 12.8913 23.3333 13.3333V15M18.3333 19.1666V24.1666M21.6667 19.1666V24.1666" stroke="#475467" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>

                    </a>
                    <div>
                      <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_785_724)">
                        <path d="M24.1667 12.5C24.3856 12.2812 24.6455 12.1076 24.9314 11.9891C25.2174 11.8707 25.5239 11.8097 25.8334 11.8097C26.1429 11.8097 26.4494 11.8707 26.7354 11.9891C27.0214 12.1076 27.2812 12.2812 27.5001 12.5C27.719 12.7189 27.8926 12.9788 28.011 13.2647C28.1295 13.5507 28.1904 13.8572 28.1904 14.1667C28.1904 14.4762 28.1295 14.7827 28.011 15.0687C27.8926 15.3547 27.719 15.6145 27.5001 15.8334L16.2501 27.0834L11.6667 28.3334L12.9167 23.75L24.1667 12.5Z" stroke="#475467" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_785_724">
                        <rect width="20" height="20" fill="white" transform="translate(10 10)"/>
                        </clipPath>
                        </defs>
                      </svg>

                    </div>
                  </div>
                </div>';
              }
            }
            ?>
        
        <div id="table-tail">
          <div>Page 1 of 10</div>
          <div>
            <button disabled>Previous</button>
            <button>Next</button>
          </div>
        </div>
        <div id="overlay"></div>
          <div class="animate__animated animate__fadeIn animate__faster" id="popup-delete" style="display: none;">
            <img src="public/header_delete.svg">
            <h1>Delete Project</h1>
            <h2>Are you sure you want to delete this project? This action cannot be undone.</h2>
            <div>
              <button onclick="deletepopup()" class="popup-delete-button">Cancel</button>
              <button onclick="deleteRecord();" class="popup-delete-button" id="popup-delete-red-button">Delete</button>
          </div>
      </div>
      <form action="upload" method="POST" enctype="multipart/form-data">
        <div id="popup-addproject" class="animate__animated animate__fadeIn animate__faster" style="display: none;">
            <div id="popup-image-top">
              <img src="public/zap.svg" />
            </div>
            <h1>New Project</h1>
            <div>
              <div class="title-input-popup">Name</div>
              <div>
                <input
                  type="text"
                  placeholder="Project Name"
                  id="popup-input-name"
                  name="popup-input-name"
                  required
                />
              </div>
              <div id="upload-container-popup">
                <div class="title-input-popup">Upload</div>
                <div type="text" id="popup-input-name">
                  <img src="public/document-icon.svg" alt="" />
                  <div id="name-upload-image">Upload Image File</div>
                    <label id="upload-button-popup">
                      Import
                      <input id="image-upload" name="image-upload" type="file" onchange="getImg(event)"></input>
                    </label>
                </div>
              </div>
              <div id="upload-container-popup">
                <div class="title-input-popup">Description</div>
                <textarea
                  type="text"
                  placeholder="Enter a description..."
                  id="popup-input-description"
                  name="popup-input-description"
                  required
                ></textarea>
                  <button type="button" class="popup-delete-button" onclick="addpopup();">Cancel</button>
                  <button
                    type="submit"
                    class="popup-delete-button"
                    id="popup-add-button-create"
                  >
                    Create
                  </button>
              </div>
            </div>
          </div>
        </div>
        </form>
      </div>
  </body>
  <script src="jquery.min.js"></script>
</html>