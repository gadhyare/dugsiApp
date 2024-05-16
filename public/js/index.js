const showSidebar = document.querySelector(".show-sidebar")
const sidebar = document.querySelector(".sidebar")
const closeBtn = document.querySelector(".close-btn")


showSidebar.addEventListener("click" , function(){
        sidebar.classList.add("active")
})


closeBtn.addEventListener("click" , function(){
        sidebar.classList.remove("active")
})
