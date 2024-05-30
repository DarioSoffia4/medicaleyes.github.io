<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if(isset($_SESSION['email'])){
    }else header("Location: index");

    require('functions/conf_db.php');

    $stmt = $conn->prepare("SELECT COUNT(project.Id) FROM project inner join user on project.idUser=user.id WHERE user.id = ?" );
    $stmt->bind_param('s',$_SESSION['name']);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
      $history_num = $row;
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <script src="app.js"></script>
    <script type="text/javascript">
    var elems = document.getElementsByClassName("confirmation");
    var confirmIt = function (e) {
        if (!confirm('Are you sure?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
</script>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
      />
    <link rel="shortcut icon" href="public/favicon.png" type="png" />
    
    <style>
      #sidebar-button-dashboard{
        background-color: rgba(57, 108, 205, 0.1);
      }
      #sidebar-button-dashboard div{
        color: #396ccd;
      }
      #sidebar-button-dashboard path{
        stroke: #396CCD;
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke-width: 2;
      }
    </style>
    <title>Welcome, <?php echo htmlspecialchars(ucfirst($_SESSION['name']), ENT_QUOTES, 'UTF-8') ?></title>
  </head>
  <body>
    <?php
      include("components/sidebar.php");
    ?>
    <div class="home-content">
      <div id="home-navbar">
        <div id="home-title">Dashboard</div>
        <div id="right-part-navbar">
          <div><button id="add-button-home" onclick="addpopup();">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
            <path d="M10.0001 4.16663V15.8333M4.16675 9.99996H15.8334" stroke="white" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
              </svg>
              New Project</button></div>
          <div id="right-profile-icon" onclick="dropmenu()">
            <img src="public/Icon Profile.png" alt="">
          </div>
          <div>
            <svg onclick="dropmenu()" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
              <path d="M0 5C0 2.23858 2.23858 0 5 0H25C27.7614 0 30 2.23858 30 5V25C30 27.7614 27.7614 30 25 30H5C2.23858 30 0 27.7614 0 25V5Z" fill="#396CCD" fill-opacity="0.1"/>
              <path d="M20 13L15 17L10 13" stroke="#396CCD" stroke-width="2.30011" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </div>
      </div>
      <div id="pop-up-profile" class="animate__animated animate__fadeIn animate__faster" style="display: none;">
        <div class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation8 MuiPopover-paper css-1ykdzux" tabindex="-1" ><span class="css-1pf3nyb"></span>
          <div class="MuiBox-root css-14oqb77">
            <h6 class="MuiTypography-root MuiTypography-subtitle2 MuiTypography-noWrap css-1k96qjc"><?php echo  htmlspecialchars(ucfirst($_SESSION['name']), ENT_QUOTES, 'UTF-8')?></h6>
            <p class="MuiTypography-root MuiTypography-body2 MuiTypography-noWrap css-10n697b"><?php echo htmlspecialchars($_SESSION['email'], ENT_QUOTES, 'UTF-8') ?>
            </p>
          </div>
          <hr class="MuiDivider-root MuiDivider-fullWidth css-1fc1cnk">
          <div class="MuiStack-root css-1kxe5pk">
            <li class="MuiButtonBase-root MuiMenuItem-root MuiMenuItem-gutters css-1j4xz7n" tabindex="-1" role="menuitem">Home<span class="MuiTouchRipple-root css-w0pj6f"></span></li>
            <li class="MuiButtonBase-root MuiMenuItem-root MuiMenuItem-gutters MuiMenuItem-root MuiMenuItem-gutters css-1j4xz7n" tabindex="-1" role="menuitem">Profile<span class="MuiTouchRipple-root css-w0pj6f"></span></li>
            <li class="MuiButtonBase-root MuiMenuItem-root MuiMenuItem-gutters MuiMenuItem-root MuiMenuItem-gutters css-1j4xz7n" tabindex="-1" role="menuitem">Settings<span class="MuiTouchRipple-root css-w0pj6f"></span></li>
          </div>
          <hr class="MuiDivider-root MuiDivider-fullWidth css-1fc1cnk">
          <li class="MuiButtonBase-root MuiMenuItem-root MuiMenuItem-gutters MuiMenuItem-root MuiMenuItem-gutters css-s2jt6i" tabindex="-1" role="menuitem" onclick="location.href='functions/logout.php';">Logout<span class="MuiTouchRipple-root css-w0pj6f"></span></li>
        </div>
      </div>
      <div id="dashboard-midpage">
        <div id="welcome-widget">
            <div id="welcome-text-container">
              <div id="welcome-title">Welcome Back 👋<br><?php echo  htmlspecialchars(ucfirst($_SESSION['name']), ENT_QUOTES, 'UTF-8')?></div>
              <div id="welcome-text">try our AI for free, lorem ipsum Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
              <div><button onclick="window.location.href='aipredict'">Try Now</button></div>
            </div>
            <div id="welcome-image">
              <img src="public/widget-welcome.png">
            </div>
        </div>
        <div class="number-project-widget">
            <div class="number-project-content">
              <div class="card-number-title-container">
                <div class="card-number-title"><?php echo  htmlspecialchars($history_num, ENT_QUOTES, 'UTF-8')?></div>
                <div class="card-number-title">Projects</div>
                <div class="card-number-subtitle">started this month</div>
                <div onclick="window.location.href='projects'">
                  <img class="svg-arrow-container" src="public/Ellipse-blue.svg" >
                  <img class="svg-arrow" src="public/arrow.svg">
                </div>
              </div>
              <svg id="svg-more" width="77" height="77" viewBox="0 0 77 77" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <circle cx="38.5" cy="38.5" r="38.5" fill="#F4F7FE"/>
                <rect x="16" y="16" width="45" height="45" fill="url(#pattern0)" fill-opacity="0.8"/>
                <defs>
                <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                <use xlink:href="#image0_609_29" transform="scale(0.00195312)"/>
                </pattern>
                <image id="image0_609_29" width="512" height="512" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAgAAAAIACAYAAAD0eNT6AAAACXBIWXMAABo/AAAaPwGViGzGAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAIABJREFUeJzs3Xuc1AW9//H35zuzu1wXFRBLS0m8hArszgo7s6iQ16wsU+meR00Jd2dBTnY59fgRWZ3UAtld9OAlKy8ZWtap7GgWKOwF3ZkBRLxfs6MIyB32MvP9/P6AOmhcZnZn5vP9zvf9fDx6nMcp3Xmlybz5XkVVQURERMHiWAcQERFR8XEAEBERBRAHABERUQBxABAREQUQBwAREVEAcQAQEREFEAcAERFRAHEAEBERBRAHABERUQBxABAREQUQBwAREVEAcQAQEREFEAcAERFRAHEAEBERBRAHABERUQBxABAREQUQBwAREVEAcQAQEREFEAcAERFRAHEAEBERBRAHABERUQBxABAREQUQBwAREVEAcQAQEREFEAcAERFRAHEAEBERBRAHABERUQBxABAREQUQBwAREVEAcQAQEREFEAcAERFRAHEAEBERBRAHABERUQBxABAREQUQBwAREVEAcQAQEREFEAcAERFRAHEAEBERBRAHABERUQBxABAREQUQBwAREVEAcQAQEREFEAcAERFRAHEAEBERBRAHABERUQBxABAREQUQBwAREVEAcQAQEREFEAcAERFRAHEAEBERBRAHABERUQBxABAREQUQBwAREVEAcQAQEREFEAcAERFRAHEAEBERBVDYOoCIiPwnNrt9oPRWRF2VCQCOFsH7AB0EoEKAjQqsV5VXBFjV0+t2di6KbLFupncTVbVuICIiH6iZniirqHA+CdUvKXAugIos/9Q0gDYoHswgfdeKlokbC5hJWeIAICKiA5o6d2m4Z8PQqxTydQBH9/PHdUNxT0bC31/RPO6VfPRR33AAEBHRftXWJyY7jtwC4OQ8/+geAE09PTqnc1FkZ55/NmWBA4CIiP7FtGn3h944Ysz/g+q3AYQK+FEvOZDPLm+u6izgZ9A+cAAQEdG71ExPDKool18qcEGRPrJbgBmtzdV3FunzCLwNkIiI9jL+2tWDy8udR4r45Q8AFQrcEYsnvlbEzww8HgEg8pGa6YmyAeXOyHRGR4TCeoQLGSkuRopghCpGCDBEHR0ClcECHKqKIRCUATj0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"/>
                </defs>
                </svg>
                  
                  
            </div>
        </div>
        <div class="number-project-widget">
            <div class="number-project-content">
              <div class="card-number-title-container">
                <div class="card-number-title"><?php echo  0/*htmlspecialchars($num_project_month, ENT_QUOTES, 'UTF-8')*/?> </div>
                <div class="card-number-title">Points</div>
                <div class="card-number-subtitle">founded this month </div>
                <div id="point-widget-arrow" onclick="window.location.href='aipredict'">
                  <img class="svg-arrow-container-right" src="public/Ellipse-blue.svg" >
                  <img class="svg-arrow-right" src="public/arrow.svg">
                </div>
              </div>
              <div>
                <img id="history-widget-image" src="public\historywidget.svg">
              </div>    
            </div>
        </div>
      </div>
      <div id="dashboard-table">
          <div id="first-table-header">
            <div id="left-header-table">
              Last Projects
            </div>
            <div id="right-header-table" onclick="window.location.href='projects'">
              <div>Go to the Projects</div>
              <div>
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="15" cy="15" r="15" fill="#396CCD" fill-opacity="0.9"/>
                  <g clip-path="url(#clip0_761_33086)">
                  <path d="M18.586 13.657L14.636 9.70704C14.4538 9.51844 14.353 9.26584 14.3553 9.00364C14.3576 8.74144 14.4628 8.49063 14.6482 8.30522C14.8336 8.11981 15.0844 8.01465 15.3466 8.01237C15.6088 8.01009 15.8614 8.11088 16.05 8.29304L21.707 13.95C21.8002 14.0427 21.8741 14.1529 21.9246 14.2742C21.9751 14.3955 22.001 14.5256 22.001 14.657C22.001 14.7884 21.9751 14.9186 21.9246 15.0399C21.8741 15.1612 21.8002 15.2714 21.707 15.364L16.05 21.021C15.9578 21.1166 15.8474 21.1927 15.7254 21.2451C15.6034 21.2976 15.4722 21.3251 15.3394 21.3263C15.2066 21.3274 15.0749 21.3021 14.952 21.2519C14.8291 21.2016 14.7175 21.1273 14.6236 21.0334C14.5297 20.9395 14.4555 20.8279 14.4052 20.705C14.3549 20.5821 14.3296 20.4504 14.3307 20.3176C14.3319 20.1849 14.3595 20.0536 14.4119 19.9316C14.4643 19.8096 14.5405 19.6993 14.636 19.607L18.586 15.657H9C8.73478 15.657 8.48043 15.5517 8.29289 15.3641C8.10536 15.1766 8 14.9223 8 14.657C8 14.3918 8.10536 14.1375 8.29289 13.9499C8.48043 13.7624 8.73478 13.657 9 13.657H18.586Z" fill="white"/>
                  </g>
                  <defs>
                  <clipPath id="clip0_761_33086">
                  <rect width="20" height="20" fill="white" transform="translate(5 5)"/>
                  </clipPath>
                  </defs>
                </svg>
              </div>
            </div>
          </div>
          <div id="second-table-header">
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
            <?php
              $stmt = $conn->prepare("SELECT project.name as nome_project,project.id,project.description,state.name, project.creationDate FROM `project`INNER JOIN user on user.Id=project.IdUser inner join state on project.idstate=state.id WHERE user.id = ? ORDER by (project.id) DESC;" );
              $stmt->bind_param('i',$_SESSION['id']);
              $stmt->execute();
              $result = $stmt->get_result();
              
              for ($i = 0; $i < 3; $i++) {
                
                $row = $result->fetch_assoc();

                if ($row) {
                echo '
                    <div class="table-record">
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
                      <img src="public/'.$row["name"].'.svg">
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
                    <a href="delete?id='.$row["id"].'" onclick="deletepopup(this);" class="confirmation">
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
          </div>
          <div id="overlay" onclick="removePopup()"></div>
          <div class="animate__animated animate__fadeIn animate__faster" id="popup-delete" style="display: none;">
            <img src="public/header_delete.svg">
            <h1>Delete Project</h1>
            <h2>Are you sure you want to delete this project? This action cannot be undone.</h2>
            <div>
              <button onclick="deletepopup()" class="popup-delete-button" id="popup-delete-cancel-button">Cancel</button>
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
        
    </div>
    
  </body>
  <script src="jquery.min.js"></script>
</html>
