<script>
    function checkDelete(){

        return confirm("Do you want to delete this book");
    
    }
</script>
<script type = "text/javascript">

    function imgUploadButton(){
    //changing the regular choose file button to custom button and adding image name beside it

    const realImgButton = document.getElementById("real-image-file");
    const customImgButton = document.getElementById("custom-img-button");
    const customImgText = document.getElementById("custom-img-text");

    customImgButton.addEventListener("click", function(){
        realImgButton.click();
         });

        realImgButton.addEventListener("change", function(){
            if(realImgButton.value){
                customImgText.innerHTML = realImgButton.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];//regex to remove whole file path and showing only the file name
            }
            else{
                    customImgText.innerHTML = "no file chosen";
                }
    });
}
    function pdfUploadButton(){
        //changing the regular choose file button to custom button and adding file name beside it

                const realPDFButton = document.getElementById("real-pdf-file");
                const customPDFButton = document.getElementById("custom-pdf-button");
                const customPDFText = document.getElementById("custom-pdf-text");

                customPDFButton.addEventListener("click", function(){
                    realPDFButton.click();
                });

                realPDFButton.addEventListener("change", function(){
                    if(realPDFButton.value){
                        customPDFText.innerHTML = realPDFButton.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];//regex to remove whole file path and showing only the file name
                    }
                    else{
                        customPDFText.innerHTML = "no file chosen";
                    }
                });

    }

 </script>
<script>
    //function for popup alert animation
    function showAlert(){
                        $('.alert').addClass("start");
                        $('.alert').addClass("show");
                        $('.alert').removeClass("hide");
                        $('.alert').addClass("showAlert");
                        setTimeout(function(){
                        $('.alert').removeClass("show");
                        $('.alert').addClass("hide");
                        $('.alert').addClass("end");
                        window.location.href = "index.php";
                        },3000);

                        $('.close-btn').click(function(){
                        $('.alert').removeClass("show");
                        $('.alert').addClass("hide");
                        $('.alert').addClass("end");
                        window.location.href = "index.php";
                    });
                }
</script>