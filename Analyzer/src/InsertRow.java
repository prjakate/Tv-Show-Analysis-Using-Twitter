import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import java.sql.Statement;

public class InsertRow {
	private static final String JDBC_DRIVER = "com.mysql.jdbc.Driver";  
	private static final String DB_URL = "jdbc:mysql://localhost/twitter";
	private static final String USER = "root";
	private static final String PASS = "prjakate";
	
	public static Connection getConn()
	{
		 Connection conn = null;		 
		 try{
		      Class.forName(JDBC_DRIVER);		      
		      conn = DriverManager.getConnection(DB_URL, USER, PASS);		      		      		      		      		     
		   }
		 catch(SQLException se){
		      se.printStackTrace();
		   }
		 catch(Exception e){
		      e.printStackTrace();
		   }		 	   
		 return conn;
	}
	
	public static void insertRow(Connection conn,String name, String type, String created_time, String inserted_time, RowValue r)
	{
		PreparedStatement stmt = null;
		try{		      		      		      		      		      		      
		      String sql = "INSERT INTO tv"+type+" values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
		      stmt = conn.prepareStatement(sql);
		      stmt.setString(1, name);
		      stmt.setString(2, created_time);
		      stmt.setString(3, inserted_time);
		      stmt.setLong(4, (Long)r.total_tweets);
		      stmt.setLong(5, (Long)r.sent_pos_count);
		      stmt.setLong(6, (Long)r.sent_neg_count);
		      stmt.setLong(7, (Long)r.sent_neu_count);
		      stmt.setLong(8, (Long)r.gend_male_count);
		      stmt.setLong(9, (Long)r.gend_female_count);
		      stmt.setLong(10, (Long)r.male_pos_count);
		      stmt.setLong(11, (Long)r.male_neg_count);
		      stmt.setLong(12, (Long)r.male_neu_count);
		      stmt.setLong(13, (Long)r.female_pos_count);
		      stmt.setLong(14, (Long)r.female_neg_count);
		      stmt.setLong(15, (Long)r.female_neu_count);
		      stmt.setLong(16, (Long)r.fav_count);
		      stmt.setLong(17, (Long)r.retweet_count);
		      stmt.setLong(18, (Long)r.device_mobile_count);
		      stmt.setLong(19, (Long)r.device_pc_count);		      
		      stmt.executeUpdate();
		      if(stmt!=null)
		            stmt.close();		  
		   }
		 catch(SQLException se){
		      se.printStackTrace();
		   }
		 catch(Exception e){
		      e.printStackTrace();
		   }		 
	}
	
	public static void updateTime(Connection conn, String time)
	{
		Statement stmt = null;
		try{		      		      		      		      
		      stmt = conn.createStatement();		      
		      String sql = "REPLACE latest_time VALUES (1,'"+time+"');";
		      stmt.executeUpdate(sql);
		      if(stmt!=null)
		            stmt.close();		  
		   }
		 catch(SQLException se){
		      se.printStackTrace();
		   }
		 catch(Exception e){
		      e.printStackTrace();
		   }		
	}
}