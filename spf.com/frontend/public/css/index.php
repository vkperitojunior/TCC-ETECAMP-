    <div class="slider">
       <div class="slides">
       
        <input type="radio" name="radio-btn" id="radio1">
        <input type="radio" name="radio-btn" id="radio2">
        <input type="radio" name="radio-btn" id="radio3">
        <input type="radio" name="radio-btn" id="radio4">
     
        <div class="slide first">
            <img src="https://nutri360.com.br/wp-content/uploads/2021/05/melhores-kits-de-suplementos.jpg" alt="img1">
        </div>
        <div class="slide">
            <img src="https://f.i.uol.com.br/fotografia/2018/04/14/15236841945ad1936298daa_1523684194_3x2_rt.jpg" alt="img2">
        </div>
        <div class="slide">
            <img src="https://www.sportraining.es/wp-content/uploads/2017/09/Suplementos-deportistas.jpg" alt="img3">
        </div>
        <div class="slide">
            <img src="https://f.i.uol.com.br/fotografia/2018/04/14/15236841945ad1936298daa_1523684194_3x2_rt.jpg" alt="img4">
        </div>

       <div class="navigation-auto">
        <div class="auto-btn1"></div>
        <div class="auto-btn2"></div>
        <div class="auto-btn3"></div>
        <div class="auto-btn4"></div>
       </div>


       </div>

       <div class="manual-navigation">

        <label for="radio1" class="manual-btn"></label>
        <label for="radio2" class="manual-btn"></label>
        <label for="radio3" class="manual-btn"></label>
        <label for="radio4" class="manual-btn"></label>

       </div>

    </div>
<script>
    var header           = document.getElementById('header');
    var navigationHeader = document.getElementById('navigation_header');
    var content          = document.getElementById('content');
    var showSidebar      = false;

    function toggleSidebar()
    {
        showSidebar = !showSidebar;
        if(showSidebar)
        {
            navigationHeader.style.marginLeft = '-10vw';
            navigationHeader.style.animationName = 'showSidebar';
            content.style.filter = 'blur(2px)';
        }
        else
        {
            navigationHeader.style.marginLeft = '-100vw';
            navigationHeader.style.animationName = '';
            content.style.filter = '';
        }
    }

    function closeSidebar()
    {
        if(showSidebar)
        {
            showSidebar = true;
            toggleSidebar();
        }
    }

    window.addEventListener('resize', function(event) {
        if(window.innerWidth > 768 && showSidebar) 
        {  
            showSidebar = true;
            toggleSidebar();
        }
    });

    let count = 1;
    document.getElementById("radio1").checked = true;
    setInterval(function(){
    nextImage();
    }, 5000)


    function nextImage(){
    count++;
    if(count>4){
        count = 1;
    }
    document.getElementById("radio"+count).checked = true;
    }

</script>
