function pageLoad(){ //inserindo caso tenha task vindo do BD
    if(document.getElementsByName('checkbox')){
        document.getElementsByName('checkbox').forEach(el => {
            el.addEventListener("change", saveTaskChecked); 
      });
    }
    if(document.getElementsByName('text')){
        document.getElementsByName('text').forEach(el => {
            el.addEventListener("change", saveTask);
      });
    }
}
