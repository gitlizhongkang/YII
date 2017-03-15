
  //点击继续添加按钮进行图片添加
  var recordFile = $("#picture div").length + $("#campus_img_box .i").length; //记录上传图片次数
  var shangChuanID = 1
  if (recordFile == 1) {
      $(".del").hide();
  }
  function lis(state, fid) {
    recordFile = $("#picture div").length + $("#campus_img_box .i").length; //记录上传图片次数
    if (state == 1) {
      if (recordFile < 10) {
        recordFile++;
        shangChuanID++;
        var $div = $("#picture");//获取主div
        addPicture(shangChuanID, $div);
      } else if (recordFile == 10) {
        alert("最多上传10个图片!");
      }
    } else if (state == 2) {
      if (recordFile == 2) {
        $(".del").hide();
      }
      $("#picture" + fid).remove();
      recordFile--;
    }
  }
 function addPicture(shangChuanID, $div) {
  //alert($div);return false;
    $div.append('<div id="picture'
            + shangChuanID + '"><input id="txt' 
            + shangChuanID
            + '"  type="text" class="input_text_200"  maxlength="25" value=""/><input style="margin-left:3px;" type="button" value="上传图片"  /><input id="file'
            + shangChuanID
            + '"  class="file_opacity" type="file" onchange=document.getElementById("txt'
            + shangChuanID
            + '").value=this.value name="image[]"><input class="del" style="margin-left:6px;" type="button"  name="" value="删除" onclick="lis(2,'
            + shangChuanID + ')" /></div>');
          if ($("#picture div").length > 1) {
              $(".del").show();
          }
  }