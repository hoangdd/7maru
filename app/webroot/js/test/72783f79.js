function Section (sectionName,sectionID,secQues,secTime,secMarks,secNegMark,consumedsecTime,consumedsecq)
			{
				this.sectionName=sectionName;
				this.sectionID=sectionID;
				this.secQues=secQues;
				this.secTime=secTime;
				this.secMarks=secMarks;
				this.secNegMark=secNegMark;
				this.consumedsecTime=consumedsecTime;
				this.consumedsecq=consumedsecq;
			}
	
			function Question(qname,type,qstring,response,img,fid,fname,b_time,diff,testids,sectionid,flag)
			{
				this.qname=qname;
				this.type=type;
				this.qstring=qstring;
				this.response=response;
				this.img=img;
				this.fid=fname;
				this.fname=fid;
				this.b_time=b_time;
				this.diff=diff;
				this.testids=testids;
				this.sectionid=sectionid
				this.flag=flag;
			}
			//document.write(a);
			var zin=1,top=0, mycount=0, waitTime=60 , qright=0, mycomment,nowtime;
			var global=new Array(3);
			var abc,xyz,tm;
			var tname = "Reading Comprehension";
			var tid = "src366";
			var cname = "RC: 1" ;
			var gg = "d";
			var recent, recent2, recdone=false, opera7, opera=CheckOpera56();
			P7_OpResizeFix();
			function P7_OpResizeFix(a) { //v1.1 by PVII
			if(!window.opera){return;}if(!document.p7oprX){
			 document.p7oprY=window.innerWidth;document.p7oprX=window.innerHeight;
			 document.onmousemove=P7_OpResizeFix;
			 }else{if(document.p7oprX){
			  var k=document.p7oprX-window.innerHeight;
			  var j=document.p7oprY - window.innerWidth;
			  if(k>1 || j>1 || k<-1 || j<-1){
			  document.p7oprY=window.innerWidth;document.p7oprX=window.innerHeight;
			  do_reposition();}}}
			}
			function cachewrite(s,idx){global[idx]+=s;}
			function CheckOpera56()
			{
			var version;
			if (navigator.userAgent.toLowerCase().indexOf('opera') == -1) return false;
			version=parseInt(navigator.appVersion.toLowerCase());
			if (version>6) {opera7=true; return false;}
			if (version<5) return false;
			return true;
			}resp=new Array("<font face=Arial size=2>ミーティング</font>","<font face=Arial size=2>メーティング</font>","<font face=Arial size=2>ミッティング</font>","<font face=Arial size=2>メティング</font>","<font face=Arial size=2>ミティング</font>","<font face=Arial size=2>ミーチング</font>","<font face=Arial size=2>10</font>");comm="";valu="";ques0 = new Question("Question0",0,"<font face=Arial size=2><b><u>内容:</u></b></font><p><font face=Arial size=2><b>Meeting をカタカナで表記しなさい。</b></font>",resp,"1000","1000","",0,0,"test_test","1",0);resp=new Array("<font face=Arial size=2>コムピュータ</font>","<font face=Arial size=2>コムピューター</font>","<font face=Arial size=2>コンプータ</font>","<font face=Arial size=2>コンピュータ</font>","<font face=Arial size=2>コムピューター</font>","<font face=Arial size=2>5</font>");comm="";valu="";ques1 = new Question("Question1",0,"<font face=Arial size=2><b><u>内容:</u></b></font><p><font face=Arial size=2><b>computer をカタカナで表記しなさい。</b></font>",resp,"1001","1001","",0,0,"test_test","1",0);resp=new Array("<font face=Arial size=2>おもふく</font>","<font face=Arial size=2>じゅうふく</font>","<font face=Arial size=2>ちょうふく</font>","<font face=Arial size=2>5</font>");comm="";valu="";ques2 = new Question("Question2",0,"<font face=Arial size=2><b><u>内容:</u></b></font><p><font face=Arial size=2><b>「重複」をひらがなで解答欄に表記しなさい。</b></font>",resp,"1002","1002","",0,0,"test_test","1",0);resp=new Array("<font face=Arial size=2>昆虫は６本足である。</font>","<font face=Arial size=2>爬虫類は全て４本足である。</font>","<font face=Arial size=2>哺乳類は全て２本足である。</font>","<font face=Arial size=2>鳥類は４本足である。</font>","<font face=Arial size=2>男性は３本足である。</font>","<font face=Arial size=2>20</font>");comm="";valu="";ques3 = new Question("Question3",0,"<font face=Arial size=2><b><u>内容:</u></b></font><p><font face=Arial size=2><b>以下の説明で適切だと思われるものを選択しなさい。</b></font>",resp,"1003","1003","",0,0,"test_test","1",0);questions = new Array (ques0,ques1,ques2,ques3);sectionArr0 = new Section("Section 1","1","3","600","1","0",0,0);sectionArr = new Array (sectionArr0);