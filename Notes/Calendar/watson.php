<div id="wrapper1">
<!-- #include file="header1.asp" -->


     <!-- begin page content -->
<div id="page">
		 	<div style="clear:all;"></div>
  <div id="container">

	
	

    <h2>Customer Comments</h2>

    <!-- begin customer comments -->
                    <%
                    
       rsHome.Close
       Set rsHome = Nothing
       
             
					Set rsComment =	Server.CreateObject("ADODB.RecordSet")
					rsComment.Source = "SELECT CommentID, " & _
					"CommentName, " & _
					"Comments " & _
					"FROM tblComment WHERE DisplayTime = '" & strDisplayTime & "';"
					
					rsComment.Open ,con
										
	If rsComment.EOF Then %>
<strong>No Comments.&nbsp;</strong>
                   
                    <% Else %>
                   
                        <p style="color:#999999;">
                        <strong>Clients Write About Their Plumbing, Heating &amp; Cooling Experience With My Dear Watson</strong></p>
<%
rsComment.MoveFirst
Do Until rsComment.EOF
%>

                        <strong><%=rsComment.Fields("CommentName")%></strong>
												<br />
										    <%=restoretick(rsComment.Fields("Comments"))%>
                        <hr style="color:#cccccc; width:100%;" />
                        
                                        
<%
rsComment.MoveNext
Loop


rsComment.Close
Set rsComment = Nothing

End If
%>

<!-- end customer comments -->

    

    
    

	
    

		
		
		
    <div style="CLEAR: both"></div>
    </div> <!-- container -->

		</div> <!-- #page --> 
</div><!-- #wrapper -->
