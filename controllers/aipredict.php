<?php

    if(!isset($_SESSION)){ 
        session_start(); 
    } 
    if(isset($_SESSION['email'])){
    }else header("Location: index");

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
      require('functions/conf_db.php');

      $stmt = $conn->prepare("SELECT project.name,project.description, state.name as state,project.creationDate FROM `project` INNER JOIN state ON project.idState=state.Id WHERE project.id = ?" );
      $stmt->bind_param('i',$_GET['id']);
      $stmt->execute();
      $result = $stmt->get_result();
      while ($row = $result->fetch_assoc()) {
        $name = $row['name'];
        $description = $row['description'];
        $creationdate = $row['creationDate'];
        $state = $row['state'];
      }
    }
    if(!isset($_GET['id'])){
      header("Location: dashboard");
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <script src="app.js"></script>
    <link rel="shortcut icon" href="public/favicon.png" type="png" />
    <title>
      Welcome, <?php echo htmlspecialchars(ucfirst($_SESSION['name']),
      ENT_QUOTES, 'UTF-8') ?>
    </title>
    <style>
      #sidebar-button-aipredict {
        background-color: rgba(57, 108, 205, 0.1);
      }
      #sidebar-button-aipredict div {
        color: #396ccd;
      }
      #sidebar-button-aipredict svg path {
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
        <div id="home-title">AI</div>
      </div>
      <div id="ai-midpage">
        <div id="container-imageinfos-ai">
          <div class="data-image-container">
            <div class="data-container-header">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14 2.26953V6.40007C14 6.96012 14 7.24015 14.109 7.45406C14.2049 7.64222 14.3578 7.7952 14.546 7.89108C14.7599 8.00007 15.0399 8.00007 15.6 8.00007H19.7305M16 13H8M16 17H8M10 9H8M14 2H8.8C7.11984 2 6.27976 2 5.63803 2.32698C5.07354 2.6146 4.6146 3.07354 4.32698 3.63803C4 4.27976 4 5.11984 4 6.8V17.2C4 18.8802 4 19.7202 4.32698 20.362C4.6146 20.9265 5.07354 21.3854 5.63803 21.673C6.27976 22 7.11984 22 8.8 22H15.2C16.8802 22 17.7202 22 18.362 21.673C18.9265 21.3854 19.3854 20.9265 19.673 20.362C20 19.7202 20 18.8802 20 17.2V8L14 2Z" stroke="#475467" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              Description 
            </div>
            <div id="description-infos-content">
              <div class="continer-align">
                <div class="title-content">Name:</div>
                <div class="element-content"><?php echo $name ?></div>
              </div>
              <div class="continer-align">
                <div class="title-content">Status:</div>
                <img src="public/<?php echo $state ?>.svg">
              </div>
              <div class="continer-align">
                <div class="title-content">Creation Date:</div>
                <div class="element-content"><?php echo $creationdate ?></div>
              </div>
              <div class="continer-align">
                <p><span class="title-content">Description:</span>   <span class="element-content"><?php echo $description?></span></p>
              </div>
          </div>
          </div>
          <div class="data-image-container">
            <div class="data-container-header">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.5 2.5L21.5 7.5M21.5 2.5L16.5 7.5M12.5 3H7.8C6.11984 3 5.27976 3 4.63803 3.32698C4.07354 3.6146 3.6146 4.07354 3.32698 4.63803C3 5.27976 3 6.11984 3 7.8V16.2C3 17.8802 3 18.7202 3.32698 19.362C3.6146 19.9265 4.07354 20.3854 4.63803 20.673C5.27976 21 6.11984 21 7.8 21H17C17.93 21 18.395 21 18.7765 20.8978C19.8117 20.6204 20.6204 19.8117 20.8978 18.7765C21 18.395 21 17.93 21 17M10.5 8.5C10.5 9.60457 9.60457 10.5 8.5 10.5C7.39543 10.5 6.5 9.60457 6.5 8.5C6.5 7.39543 7.39543 6.5 8.5 6.5C9.60457 6.5 10.5 7.39543 10.5 8.5ZM14.99 11.9181L6.53115 19.608C6.05536 20.0406 5.81747 20.2568 5.79643 20.4442C5.77819 20.6066 5.84045 20.7676 5.96319 20.8755C6.10478 21 6.42628 21 7.06929 21H16.456C17.8951 21 18.6147 21 19.1799 20.7582C19.8894 20.4547 20.4547 19.8894 20.7582 19.1799C21 18.6147 21 17.8951 21 16.456C21 15.9717 21 15.7296 20.9471 15.5042C20.8805 15.2208 20.753 14.9554 20.5733 14.7264C20.4303 14.5442 20.2412 14.3929 19.8631 14.0905L17.0658 11.8527C16.6874 11.5499 16.4982 11.3985 16.2898 11.3451C16.1061 11.298 15.9129 11.3041 15.7325 11.3627C15.5279 11.4291 15.3486 11.5921 14.99 11.9181Z" stroke="#475467" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              Other Images
            </div>
            <div class="other-img-element">
              <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="40" height="40" rx="20" fill="#F4EBFF"/>
                <path d="M14.1667 27.5H25.8333C26.7538 27.5 27.5 26.7538 27.5 25.8333V14.1667C27.5 13.2462 26.7538 12.5 25.8333 12.5H14.1667C13.2462 12.5 12.5 13.2462 12.5 14.1667V25.8333C12.5 26.7538 13.2462 27.5 14.1667 27.5ZM14.1667 27.5L23.3333 18.3333L27.5 22.5M18.3333 17.0833C18.3333 17.7737 17.7737 18.3333 17.0833 18.3333C16.393 18.3333 15.8333 17.7737 15.8333 17.0833C15.8333 16.393 16.393 15.8333 17.0833 15.8333C17.7737 15.8333 18.3333 16.393 18.3333 17.0833Z" stroke="#396CCD" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <div>
                <div class="image-title"><?php echo $name ?></div>
                <div class="image-size">720 KB</div>
              </div>
            </div>
          </div>
        </div>
        <canvas id="div-image-ai" width="600px" height="750px">
        </canvas>
        <script>
          let canvas = document.getElementById('div-image-ai');
          let ctx = canvas.getContext('2d');
          
          <?php
            $upload_dir = 'uploads/'.$_SESSION['id'].'/'.$_GET['id'].'/';
            $files = scandir($upload_dir);
            foreach ($files as $file){
              $filePath = $upload_dir . '/' . $file;
            }
          ?>
          var img = new Image();
          let  imagejson;
          img.src = "<?php echo $filePath ?>";
          img.onload = () => {
            ctx.drawImage(img,0,0);
            lar=img.naturalWidth;
            alt=img.naturalHeight;

            let array;
            ctx.drawImage(img,0,0,img.naturalWidth,img.naturalHeight);

            let imageData=ctx.getImageData(0, 0, img.naturalWidth, img.naturalHeight);
            array=buildRgb(imageData);
            matrix=listToMatrix(array,img.naturalWidth);
            let image ={
                nome: "lastra",
                width: lar,
                height: alt,
                matrix: matrix
              };  
              console.log(image);
            imagejson = JSON.stringify(image);
          }

        function sendApiImage(){
          console.log("mandato");
          const xhr = new XMLHttpRequest();
          xhr.open("POST", "http://10.0.95.196:8080/cefalometricoConApi/api/images/add", true);
          xhr.setRequestHeader("Content-Type", "application/json");
          document.getElementById("start-ai-button").innerHTML = "Inviato";
          document.getElementById("start-ai-button").disabled = true;
    
          xhr.onreadystatechange = () => {

                      if (xhr.readyState === XMLHttpRequest.DONE) {
                      console.log("RISPOSTA")
                      console.log(xhr.response);
                      document.getElementById("start-ai-button").innerHTML = "Ricevuto"
                      var image = new Image();
                      image.onload = function() {
                        ctx.drawImage(image, 0, 0);
                      };
                      image.src = xhr.response;
                      }
                  };

          xhr.send(imagejson);
        }

        function listToMatrix(list, elementsPerSubArray) {
                let matrix = [], i, k;
                
                //  console.log(list.length);
                for (i = 0, k = -1; i < list.length; i++) {
                    if (i % elementsPerSubArray === 0) {
                        k++;
                        matrix[k] = [];
                    }
                    matrix[k].push(list[i]);
                }

                return matrix;
        }

        function buildRgb (imageData)  {
            let rgbValues = [];
            let red,green,blu,alpha;
            for (let i = 0; i < imageData.data.length; i += 4) {
                red= imageData.data[i];
                green= imageData.data[i + 1];
                blu= imageData.data[i + 2];
                alpha= imageData.data[i+3];
                alpha=alpha<<24;
                red=red<<16;
                green=green<<8
                let color=(alpha | red | green | blu);
    
                rgbValues.push(color);
            }
            return rgbValues;
            };

            function downloadImage() {

              let canvas = document.getElementById("div-image-ai");
              var dataURL = canvas.toDataURL("image/png");
              var a = document.createElement('a');
              a.href = dataURL
              a.download = "<?php echo $filePath ?>";
              a.click();
            }
          
        </script>
        <div>
        <div id="right-info">
          <div class="data-container-header">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M15.5 11.5H14.5L13 14.5L11 8.5L9.5 11.5H8.5M11.9932 5.13581C9.9938 2.7984 6.65975 2.16964 4.15469 4.31001C1.64964 6.45038 1.29697 10.029 3.2642 12.5604C4.75009 14.4724 8.97129 18.311 10.948 20.0749C11.3114 20.3991 11.4931 20.5613 11.7058 20.6251C11.8905 20.6805 12.0958 20.6805 12.2805 20.6251C12.4932 20.5613 12.6749 20.3991 13.0383 20.0749C15.015 18.311 19.2362 14.4724 20.7221 12.5604C22.6893 10.029 22.3797 6.42787 19.8316 4.31001C17.2835 2.19216 13.9925 2.7984 11.9932 5.13581Z" stroke="#475467" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Points
          </div>
          <div id="points-table">
            <div id="row-name">
              <div class="header-row point-name">Name</div>
              <div class="point-name">Sts</div>
              <div class="point-name">G'</div>
              <div class="point-name">SOr</div>
              <div class="point-name">N</div>
              <div class="point-name">S</div>
              <div class="point-name">Co</div>
              <div class="point-name border-modified-left">A</div>
            </div>
            <div id="row-value">
              <div class="header-row point-value">Value</div>
              <div class="point-value"></div>
              <div class="point-value"></div>
              <div class="point-value"></div>
              <div class="point-value"></div>
              <div class="point-value"></div>
              <div class="point-value"></div>
              <div class="point-value"></div>
            </div>
            <div id="row-description">
              <div class="header-row point-description">Description</div>
              <div class="point-description">The center of cella turtica</div>
              <div class="point-description">The lowest point on the mandibula...</div>
              <div class="point-description">Also known as Orbitale, it is the...</div>
              <div class="point-description">The most posterior point of the...</div>
              <div class="point-description">It is the most superior point on the...</div>
              <div class="point-description">the center of cella turtica</div>
              <div class="point-description border-modified">The deepest point on the anterior</div>
            </div>

          </div>
        </div>
        <div id="container-ai-buttons">
          <button type="button" class="popup-delete-button" onclick="window.location.href='projects'">Cancel</button>
          <button
            type="submit"
            class="popup-delete-button"
            id="start-ai-button"
            onclick="sendApiImage()"
          >
            Start
          </button>
        </div>
        </div>
        
      </div>
      <button id="button-export" onclick="downloadImage();">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 12.5V6.8C20 5.11984 20 4.27976 19.673 3.63803C19.3854 3.07354 18.9265 2.6146 18.362 2.32698C17.7202 2 16.8802 2 15.2 2H8.8C7.11984 2 6.27976 2 5.63803 2.32698C5.07354 2.6146 4.6146 3.07354 4.32698 3.63803C4 4.27976 4 5.11984 4 6.8V17.2C4 18.8802 4 19.7202 4.32698 20.362C4.6146 20.9265 5.07354 21.3854 5.63803 21.673C6.27976 22 7.1198 22 8.79986 22H12.5M14 11H8M10 15H8M16 7H8M15 19L18 22M18 22L21 19M18 22V16" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Save
      </button>
    </div>
  </body>
  <script src="jquery.min.js"></script>
</html>
