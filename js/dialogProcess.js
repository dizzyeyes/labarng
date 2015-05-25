    function submitfun(formid)
    {
        var form1 = iBase.Id(formid);
        var inputId = form1.inputId;
        var inputIdContent = inputId.value;       
        //验证ID的有效性,是否为空，是否可以添加到列表中（唯一性）
        //如果可以，就隐藏对话框，并改变对应的数据。
        if(chkinput(form1)==false) return false;
        if(assertDuplicateId(inputIdContent)==false)
        //如果不可以添加，alert并返回。
        {           
            return false;
        }
        else
        {
           hideDialogue(formid);
           processFormData(formid);
           clearFormData(formid);
           return true;
        }
    }
    function alertInputForm(msg)
    {
        $('.alert').show().html(' <strong>' + msg + '</strong>');
    }
    function chkinput(form)
    {
        if(form.inputId.value=="")
        {
            alertInputForm("请输入ID");
            form.inputId.select();
            showWrongImg('inputIdIcon');
            return(false);
        }
        if(form.inputName.value=="")
        {
            alertInputForm("请输入名称");
            form.inputName.select();
            showWrongImg('inputNameIcon');
            return(false);
        }
        if(form.inputModel.value=="")
        {
            alertInputForm("请输入模型文件");
            form.inputModel.select();
            showWrongImg('inputModelIcon');
            return(false);
        }
        if (!assertDuplicateId(form.inputId.value))  return false;
        if(!assertValidModelType(form.inputModel.value)) return false;
        return(true);
    }

    function cancelsubmitfun(formid)
    {       
        hideDialogue(formid);
        clearFormData(formid);
       //隐藏对话框，并清空表。
        return true;
    }
    function hideDialogue(formid)
    {        
        fadeOut(iBase.Id(formid));
        // var form1 = document.getElementById(formid);
        // form1.style.display = 'none';
    }
    function showDialogue(formid)
    {        
        fadeIn(iBase.Id(formid),40);
        // var form1 = document.getElementById(formid);
        // form1.style.display = 'block';
    }
    function clearFormData(formid)
    {
        console.log("清理表格中。。。");
        iBase.Id(formid).inputId.value="";
        iBase.Id(formid).inputName.value="";
        iBase.Id(formid).inputModel.value="";
        iBase.Id(formid).inputInfo.value="";
        clearIconImg('inputIdIcon');
        clearIconImg('inputModelIcon');
        clearIconImg('inputNameIcon');
    }
    function processFormData(formid)
    {        
        var id=iBase.Id(formid).inputId.value;
        var name=iBase.Id(formid).inputName.value;
        var modelpath=iBase.Id(formid).inputModel.value;
        var info=iBase.Id(formid).inputInfo.value;
        console.log("处理表格数据中。。。"+id+name+modelpath+info);
    }
    
    function assertDuplicateId(inputIdContent)
    {
        console.log("assertDuplicateId...");
        var iconid='inputIdIcon';
        if(true)
        {
            alertInputForm("ID:"+inputIdContent+"可以使用");
            showYesImg(iconid);
            return true;
        }
        else
        {            
            alertInputForm("ID:"+inputIdContent+"已存在，请重命名");
            showWrongImg(iconid);
            return false;
        }
    }
    function assertValidModelType(modelpath)
    {
        var iconid='inputModelIcon';
        var modelpart=modelpath.split('.');
        var modeltype=modelpart[modelpart.length-1];
        console.log("assertValidModelType...");
        if(modeltype!='obj')
        {
            alertInputForm("请使用正确的文件格式(*.obj)");
            showWrongImg(iconid);
            return false;
        }
        showYesImg(iconid);
        return true;
    }
    function showYesImg(iconid)
    {        
        iBase.Id(iconid).src='icons/yes.png';
    }
    function showWrongImg(iconid)
    {
        iBase.Id(iconid).src='icons/wrong.png';
    }
    function clearIconImg(iconid)
    {
        iBase.Id(iconid).src='';
    }