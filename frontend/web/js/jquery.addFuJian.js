
  //���������Ӱ�ť����ͼƬ���
  var recordFile = $("#picture div").length + $("#campus_img_box .i").length; //��¼�ϴ�ͼƬ����
  var shangChuanID = 1
  if (recordFile == 1) {
      $(".del").hide();
  }
  function lis(state, fid) {
    recordFile = $("#picture div").length + $("#campus_img_box .i").length; //��¼�ϴ�ͼƬ����
    if (state == 1) {
      if (recordFile < 10) {
        recordFile++;
        shangChuanID++;
        var $div = $("#picture");//��ȡ��div
        addPicture(shangChuanID, $div);
      } else if (recordFile == 10) {
        alert("����ϴ�10��ͼƬ!");
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
            + '"  type="text" class="input_text_200"  maxlength="25" value=""/><input style="margin-left:3px;" type="button" value="�ϴ�ͼƬ"  /><input id="file'
            + shangChuanID
            + '"  class="file_opacity" type="file" onchange=document.getElementById("txt'
            + shangChuanID
            + '").value=this.value name="image[]"><input class="del" style="margin-left:6px;" type="button"  name="" value="ɾ��" onclick="lis(2,'
            + shangChuanID + ')" /></div>');
          if ($("#picture div").length > 1) {
              $(".del").show();
          }
  }