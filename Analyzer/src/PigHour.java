import org.apache.pig.*;
import org.apache.pig.backend.executionengine.ExecException;
import org.apache.pig.data.Tuple;

import java.sql.*;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.io.*;
import java.util.*;
import java.util.Date;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.ParserConfigurationException;

import org.w3c.dom.Document;
import org.w3c.dom.Element;
import org.w3c.dom.NodeList;
import org.xml.sax.SAXException;

public class PigHour {	
	public static void main(String args[])throws ExecException,IOException,SQLException,FileNotFoundException, IOException, SAXException,
	ParserConfigurationException 
	{				
		BufferedReader in=new BufferedReader(new  InputStreamReader(System.in));
		//Get pig path
		System.out.println("Enter the path for pigreferences:");
		String pig_path=in.readLine();
		//Get start time for summary
		System.out.println("Enter the starting time for summary:");
		String time=in.readLine();
		in.close();				
		//Fetch Lists from XML files
		File showXmlFile = new File("xml/shows.xml");
		File characterXmlFile = new File("xml/characters.xml");
		DocumentBuilderFactory dbFactory = DocumentBuilderFactory.newInstance();
		DocumentBuilder dBuilder = dbFactory.newDocumentBuilder();
		Document doc = dBuilder.parse(showXmlFile);
		doc.getDocumentElement().normalize();
		NodeList showList = doc.getElementsByTagName("show");
		doc = dBuilder.parse(characterXmlFile);
		doc.getDocumentElement().normalize();
		NodeList characterList = doc.getElementsByTagName("character");					
		//Prepare PigServer
		Properties props = new Properties();
		props.setProperty("fs.default.name", "hdfs://localhost:9000");
		props.setProperty("mapred.job.tracker", "localhost:9001");
		PigServer pigServer = new PigServer(ExecType.MAPREDUCE,props);	
		//Register Pig Jars
	    pigServer.registerJar(pig_path+"mongo-2.7.3.jar");
	    pigServer.registerJar(pig_path+"commons-lang-2.6.jar");
	    pigServer.registerJar(pig_path+"mongo-hadoop-core_0.20.205.0-1.1.0.jar");
	    pigServer.registerJar(pig_path+"mongo-hadoop-pig_0.20.205.0-1.1.0.jar");
	    pigServer.registerJar(pig_path+"mysql-connector-java-5.1.29.jar");
	    pigServer.registerJar(pig_path+"joda-time.jar");
	    pigServer.registerJar(pig_path+"pig-0.12.0.jar");
	    pigServer.registerJar(pig_path+"piggybank-0.12.0.jar");
	    //Pig script
	    pigServer.registerQuery("ret_tweets = LOAD 'mongodb://127.0.0.1:27017/twitter.tweets' USING com.mongodb.hadoop.pig.MongoLoader('user_id, show_list, character_list, device, inserted_at, sentiment, retweet_count, favorite_count, created_at') AS (user_id:chararray, show_list:chararray, character_list:chararray, device:chararray, inserted_at:chararray, sentiment:chararray, retweet_count:long, favorite_count:long, created_at:chararray);");
	    pigServer.registerQuery("users = LOAD 'mongodb://127.0.0.1:27017/twitter.users' USING com.mongodb.hadoop.pig.MongoLoader('id_str, gender') AS (id_str:chararray, gender:chararray);");	    	    	    
	    Iterator<Tuple> ret_it=pigServer.openIterator("ret_tweets");
	    if(ret_it.hasNext())
	    {	    	
	    //JOIN only once
	    pigServer.registerQuery("tweet_user = JOIN ret_tweets BY user_id, users BY id_str;");	
	    //For each show and character call the Pig Script
	    for(int shownumber = 0; shownumber < showList.getLength(); shownumber++) {
			Element show = (Element) showList.item(shownumber);
			String name=show.getElementsByTagName("name").item(0).getTextContent();			
	    	runMyQuery(pigServer, "show", name.toLowerCase(), time);
			}
		for(int characternumber = 0; characternumber < characterList.getLength(); characternumber++) {
			Element character = (Element) characterList.item(characternumber);
			String name=character.getElementsByTagName("name").item(0).getTextContent();		
	    	runMyQuery(pigServer, "character", name.toLowerCase(), time);
			}	 	    	    
	    }
	    pigServer.shutdown();
	    //Update time of summary in latest_time
	    Connection conn=null;
	    conn=InsertRow.getConn();
	    InsertRow.updateTime(conn, time);	    
	    if(conn!=null)
            conn.close();
	    //Display time of Program End
	    DateFormat dateFormat = new SimpleDateFormat("yyyy/MM/dd HH:mm:ss");
		Date date = new Date();
		String datestring=dateFormat.format(date);
		System.out.println(datestring);
	}
	
	public static void runMyQuery(PigServer pigServer,String type, String name, String  time_start) throws IOException,SQLException {		 		   
	       pigServer.registerQuery("tweets = FILTER tweet_user BY "+type+"_list MATCHES '.*"+name+".*';");
	       Iterator<Tuple> join_it=pigServer.openIterator("tweets");
	       if(join_it.hasNext())
	       {	       	       	     	    	   
	       Map<String, RowValue> values=new HashMap<String, RowValue>();
	       while(join_it.hasNext())
	       {	    	   
	    	   Tuple row=join_it.next();
	    	   RowValue r=null;
	    	   String created_at="";
	    	   if(row.get(8)!=null)
	    	   {
	    		   created_at=String.valueOf(row.get(8));
	    		   created_at=created_at.substring(0, 14);
	    		   created_at+="00:00";
	    		   if(values.containsKey(created_at))
	    			   r=values.get(created_at);
	    		   else
	    			   r=new RowValue(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
	    	   }
	    	   r.total_tweets++;
	    	   if(row.get(5)!=null)
	    	   {
	    	   if(String.valueOf(row.get(5)).equals("pos"))
	    	   {
	    		   r.sent_pos_count++;
	    	   }
	    	   else if(String.valueOf(row.get(5)).equals("neg"))
	    	   {
	    		   r.sent_neg_count++;
	    	   }
	    	   else if(String.valueOf(row.get(5)).equals("neu"))
	    	   {
	    		   r.sent_neu_count++;
	    	   }
	    	   }
	    	   if(row.get(10)!=null)
	    	   {
	    	   if(String.valueOf(row.get(10)).equals("male"))
	    	   {
	    		   r.gend_male_count++;
	    	   }
	    	   else if(String.valueOf(row.get(10)).equals("female"))
	    	   {
	    		   r.gend_female_count++;
	    	   }
	    	   }
	    	   if(row.get(5)!=null&&row.get(10)!=null)
	    	   {
	    	   if(String.valueOf(row.get(5)).equals("pos")&&String.valueOf(row.get(10)).equals("male"))
	    	   {
	    		   r.male_pos_count++;
	    	   }
	    	   else if(String.valueOf(row.get(5)).equals("neg")&&String.valueOf(row.get(10)).equals("male"))
	    	   {
	    		   r.male_neg_count++;
	    	   }	    	 
	    	   else if(String.valueOf(row.get(5)).equals("neu")&&String.valueOf(row.get(10)).equals("male"))
	    	   {
	    		   r.male_neu_count++;
	    	   }
	    	   if(String.valueOf(row.get(5)).equals("pos")&&String.valueOf(row.get(10)).equals("female"))
	    	   {
	    		   r.female_pos_count++;
	    	   }
	    	   else if(String.valueOf(row.get(5)).equals("neg")&&String.valueOf(row.get(10)).equals("female"))
	    	   {
	    		   r.female_neg_count++;
	    	   }	    	 
	    	   else if(String.valueOf(row.get(5)).equals("neu")&&String.valueOf(row.get(10)).equals("female"))
	    	   {
	    		   r.female_neu_count++;
	    	   }	    	   
	    	   }
	    	   r.fav_count+=(Long)row.get(7);
	    	   r.retweet_count+=(Long)row.get(6);
	    	   if(row.get(3)!=null)
	    	   {
	    	   if(String.valueOf(row.get(3)).equals("mobile"))
	    	   {
	    		   r.device_mobile_count++;
	    	   }
	    	   else if(String.valueOf(row.get(3)).equals("pc"))
	    	   {
	    		   r.device_pc_count++;
	    	   }
	    	   }	
	    	   values.put(created_at, r);
	       }
	       Connection conn=InsertRow.getConn();	       
	       for (Map.Entry<String, RowValue> entry : values.entrySet()) {	   			    	
	   		InsertRow.insertRow(conn, name, type, entry.getKey(), time_start, entry.getValue());
	       }	       
	       if(conn!=null)
	            conn.close();
	       }
	   }
}
