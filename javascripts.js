// Custom JS for background color on scrolling
 $(window).scroll(function(){
    var scroll = $(window).scrollTop();
    if(scroll < 200){
        $('.fixed-top').css('background', 'transparent');
        $('.nav-link').css('color','white');
        $('.ApageNav').css('border-bottom', '1px solid transparent');
    } else{
        $('.ApageNav').css('background', 'white');
        $('.ApageNav').css('border-bottom', '1px solid rgba(0, 0, 0, 0.11)');
        $('.nav-link').css('color','black');
    }
});



/*admin panel*/

//tabs
const tabs = document.querySelectorAll('[data-tab-target]')
const tabContents = document.querySelectorAll('[data-tab-content]')

tabs.forEach(tab => {
  tab.addEventListener('click', () => {
    const target = document.querySelector(tab.dataset.tabTarget)

    tabContents.forEach(tabContent => {
      tabContent.classList.remove('active')
    })
    tabs.forEach(tab => {
      tab.classList.remove('active')
    })
    tab.classList.add('active')
    target.classList.toggle('active')
  })
})

//edit
//tabs
const forms = document.querySelectorAll('[data-form-target]')
const formContents = document.querySelectorAll('[data-form-content]')

forms.forEach(form => {
  form.addEventListener('click', () => {
    const target = document.querySelector(form.dataset.formTarget)

    formContents.forEach(formContent => {
      //formContent.classList.remove('active')
    })
    forms.forEach(tab => {
      //form.classList.remove('active')
    })
    form.classList.toggle('active')
    target.classList.toggle('active')
  })
})
