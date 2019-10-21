 var multiple = new Dropdown({
    dom: 'multipleSelect',//点击触发下拉的选择框的id
    type: 'multiple',//是单选还是多选 单选 single 多选 multiple
    title: '',//选择框title
    required: false,//是否必填
    dataArr: [ // id不可重复
      {
        id: '1',
        cont: '不限'
      },
      {
        id: '2',
        cont: '一室'
      },
      {
        id: '3',
        cont: '二室'
      },
      {
        id: '4',
        cont: '三室'
      },
      {
        id: '5',
        cont: '四室及以上'
      }
    ],
    success: function (resp) { // 回调函数
        console.log(resp)
      var val = '';
      if(resp.length>0){
        for(var i in resp){
          val += resp[i].cont + ' '
        }
      }else{
        val =  '多选请选择'
      }
       $('#multipleSelect').html(val)
      
    }
  })
 // var per = new dropdown(true)