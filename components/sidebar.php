<?php
    if(isset($_SESSION['email'])){
    }else header("Location: index.html");

    require("functions/conf_db.php");

    $stmt = $conn->prepare("SELECT COUNT(project.Id) AS number_hi FROM project inner join user on project.idUser=user.id WHERE user.id = ?" );
    $stmt->bind_param('i',$_SESSION['id']);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
      $history_num = $row['number_hi'];
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div id="sidebar">
      <div id="logo">
        <img src="public/logo.png" />
      </div>
      <div id="account-container">
        <div id="icon-account">
          <img src="public/icon-account.png" alt="" />
        </div>
        <div id="info-account-container">
          <div id="account-name"><?php echo  htmlspecialchars(ucfirst($_SESSION['name']), ENT_QUOTES, 'UTF-8') ?></div>
          <div id="account-email"><?php echo htmlspecialchars($_SESSION['email'], ENT_QUOTES, 'UTF-8') ?></div>
        </div>
        <div id="logout-icon"><img src="public/logout-icon.png" onclick="location.href='functions/logout.php';" /></div>
      </div>
      <div class="container-buttons">
        <div class="sidebar-button" id="sidebar-button-dashboard" onclick="location.href='dashboard';">
          <div class="button-leftside">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M10 3H3V10H10V3Z" stroke="#475467" stroke-opacity="0.7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M21 3H14V10H21V3Z" stroke="#475467" stroke-opacity="0.7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M21 14H14V21H21V14Z" stroke="#475467" stroke-opacity="0.7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M10 14H3V21H10V14Z" stroke="#475467" stroke-opacity="0.7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
            <div class="button-title">Dashboard</div>
          </div>
          <svg xmlns="http://www.w3.org/2000/svg" class="svg-open-button" width="9" height="17" viewBox="0 0 9 17" fill="none">
            <path d="M2 2L6.92543 8.51698L2 15.034" stroke="#404040" stroke-opacity="0.7" stroke-width="2.30011" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </svg>
        </div>
        <div id="sidebar-button-aipredict" class="sidebar-button" onclick="location.href='aipredict';">
          <div class="button-leftside">
            <svg xmlns="http://www.w3.org/2000/svg" id="sidebar-button-aipredict-svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
              <g clip-path="url(#clip0_752_11228)">
              <path d="M9 1V4M15 1V4M9 20V23M15 20V23M20 9H23M20 14H23M1 9H4M1 14H4M6 4H18C19.1046 4 20 4.89543 20 6V18C20 19.1046 19.1046 20 18 20H6C4.89543 20 4 19.1046 4 18V6C4 4.89543 4.89543 4 6 4ZM9 9H15V15H9V9Z" stroke="#475467" stroke-opacity="0.7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </g>
              <defs>
              <clipPath id="clip0_752_11228">
              <rect width="24" height="24" fill="white"/>
              </clipPath>
              </defs>
            </svg>
            <div class="button-title">AI</div>
          </div>
        </div>
        <div id="sidebar-button-history" class="sidebar-button" onclick="location.href='projects';">
          <div class="button-leftside">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M13 7L11.8845 4.76892C11.5634 4.1268 11.4029 3.80573 11.1634 3.57116C10.9516 3.36373 10.6963 3.20597 10.4161 3.10931C10.0992 3 9.74021 3 9.02229 3H5.2C4.0799 3 3.51984 3 3.09202 3.21799C2.71569 3.40973 2.40973 3.71569 2.21799 4.09202C2 4.51984 2 5.0799 2 6.2V7M2 7H17.2C18.8802 7 19.7202 7 20.362 7.32698C20.9265 7.6146 21.3854 8.07354 21.673 8.63803C22 9.27976 22 10.1198 22 11.8V16.2C22 17.8802 22 18.7202 21.673 19.362C21.3854 19.9265 20.9265 20.3854 20.362 20.673C19.7202 21 18.8802 21 17.2 21H6.8C5.11984 21 4.27976 21 3.63803 20.673C3.07354 20.3854 2.6146 19.9265 2.32698 19.362C2 18.7202 2 17.8802 2 16.2V7Z" stroke="#404040" stroke-opacity="0.7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

            <div class="button-title">Projects</div>
          </div>
          <div class="svg-open-button" id="space"><?php echo htmlspecialchars($history_num, ENT_QUOTES, 'UTF-8')?></div>
        </div>
      </div>
      <div id="user-space-container">
        <div id="user-space-limiter">
          <div id="pop-up-top">
            <div id="pop-up-title">User Space</div>
            <div id="pop-up-close" onclick="removeDiv()"><img id="close-img" src="public/close.png"></div>
          </div>
          <div id="pop-up-text">
            You has used 5/10 of your available projects.
          </div>
          <div id="pop-up-progress">
            <svg xmlns="http://www.w3.org/2000/svg" width="197" height="10" viewBox="0 0 197 10" fill="none">
              <rect width="197" height="10" rx="5" fill="white"/>
              <rect x="0.4" y="0.4" width="196.2" height="9.2" rx="4.6" stroke="#396CCD" stroke-opacity="0.6" stroke-width="0.8"/>
              <rect width="98.5" height="10" rx="5" fill="#396CCD"/>
            </svg>
          </div>
        </div>
        
      </div>
      <div class="delimiter"></div>
      <div class="container-buttons" id="settings-button">
        <div class="sidebar-button" >
          <div class="button-leftside">
            <svg id="setting" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g >
              <path id="Vector" d="M3.12493 17.2917L4.37493 19.1667C4.99993 20.2084 6.24993 20.625 7.39576 20.2084L8.5416 19.7917L8.8541 20.9375C9.1666 22.0834 10.2083 22.9167 11.3541 22.9167H13.6458C14.7916 22.9167 15.8333 22.0834 16.1458 20.9375L16.4583 19.7917L17.4999 20.2084C18.6458 20.625 19.8958 20.2084 20.5208 19.1667L21.7708 17.2917C22.3958 16.25 22.2916 15 21.5624 14.0625L20.1041 12.5L21.5624 10.9375C22.3958 10.1042 22.4999 8.75004 21.8749 7.70837L20.6249 5.83337C19.9999 4.79171 18.7499 4.37504 17.6041 4.79171L16.4583 5.20837L16.1458 4.06254C15.8333 2.91671 14.7916 2.08337 13.6458 2.08337H11.3541C10.2083 2.08337 9.1666 2.91671 8.8541 4.06254L8.5416 5.10421L7.49993 4.68754C6.3541 4.27087 5.1041 4.68754 4.4791 5.72921L3.2291 7.60421C2.6041 8.64587 2.70826 9.89587 3.43743 10.8334L4.89576 12.5L3.43743 14.0625C2.6041 14.8959 2.49993 16.25 3.12493 17.2917ZM4.99993 15.5209L7.18743 13.2292C7.6041 12.8125 7.6041 12.1875 7.18743 11.7709L5.1041 9.47921C4.89576 9.27087 4.89576 9.06254 5.1041 8.85421L6.3541 6.97921C6.45826 6.77087 6.77076 6.66671 6.9791 6.77087L9.1666 7.50004C9.4791 7.60421 9.7916 7.60421 9.99993 7.39587C9.99993 7.29171 10.2083 7.08337 10.3124 6.77087L10.8333 4.58337C10.9374 4.37504 11.1458 4.16671 11.3541 4.16671H13.6458C13.8541 4.16671 14.0624 4.37504 14.1666 4.58337L14.6874 6.87504C14.7916 7.18754 14.8958 7.39587 15.2083 7.50004C15.4166 7.60421 15.7291 7.70837 16.0416 7.60421L18.2291 6.87504C18.4374 6.77087 18.7499 6.87504 18.8541 7.08337L20.1041 8.95837C20.2083 9.16671 20.2083 9.37504 19.9999 9.58337L17.8124 11.875C17.3958 12.2917 17.3958 12.9167 17.8124 13.3334L19.8958 15.625C20.1041 15.8334 20.1041 16.0417 19.8958 16.25L18.6458 18.125C18.5416 18.3334 18.2291 18.4375 18.0208 18.3334L15.8333 17.6042C15.5208 17.5 15.2083 17.5 14.9999 17.7084C14.6874 17.8125 14.5833 18.125 14.4791 18.3334L13.9583 20.5209C13.8541 20.7292 13.6458 20.9375 13.4374 20.9375H11.1458C10.9374 20.9375 10.7291 20.7292 10.6249 20.5209L10.1041 18.2292C9.99993 17.9167 9.89576 17.7084 9.58326 17.6042C9.4791 17.5 9.27076 17.5 9.06243 17.5C8.95826 17.5 8.8541 17.5 8.74993 17.6042L6.56243 18.3334C6.3541 18.4375 6.0416 18.3334 5.93743 18.125L4.68743 16.25C4.7916 15.9375 4.7916 15.625 4.99993 15.5209Z" fill="#404040" fill-opacity="0.7"/>
              <path id="Vector_2" d="M12.4999 16.6667C14.7916 16.6667 16.6666 14.7917 16.6666 12.5C16.6666 10.2084 14.7916 8.33337 12.4999 8.33337C10.2083 8.33337 8.33325 10.2084 8.33325 12.5C8.33325 14.7917 10.2083 16.6667 12.4999 16.6667ZM12.4999 10.4167C13.6458 10.4167 14.5833 11.3542 14.5833 12.5C14.5833 13.6459 13.6458 14.5834 12.4999 14.5834C11.3541 14.5834 10.4166 13.6459 10.4166 12.5C10.4166 11.3542 11.3541 10.4167 12.4999 10.4167Z" fill="#404040" fill-opacity="0.7"/>
              </g>
              </svg>
              
            <div class="button-title">Settings</div>
          </div>
          <svg xmlns="http://www.w3.org/2000/svg" class="svg-open-button" width="9" height="17" viewBox="0 0 9 17" fill="none">
            <path d="M2 2L6.92543 8.51698L2 15.034" stroke="#404040" stroke-opacity="0.7" stroke-width="2.30011" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </svg>
        </div>
      </div>
      
    </div>
</body>
</html>