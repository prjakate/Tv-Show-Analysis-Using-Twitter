
public class RowValue {
	long total_tweets,sent_pos_count,sent_neg_count,sent_neu_count,gend_male_count,gend_female_count,male_pos_count,male_neg_count,male_neu_count,female_pos_count,female_neg_count,female_neu_count,fav_count,retweet_count,device_mobile_count,device_pc_count;
	public RowValue(long total_tweets,long sent_pos_count,long sent_neg_count,long sent_neu_count,long gend_male_count,long gend_female_count,long male_pos_count,long male_neg_count,long male_neu_count,long female_pos_count,long female_neg_count,long female_neu_count,long fav_count,long retweet_count,long device_mobile_count,long device_pc_count)
	{
		this.total_tweets=total_tweets;
		this.sent_pos_count=sent_pos_count;
		this.sent_neg_count=sent_neg_count;
		this.sent_neu_count=sent_neu_count;
		this.gend_male_count=gend_male_count;
		this.gend_female_count=gend_female_count;
		this.male_pos_count=male_pos_count;
		this.male_neg_count=male_neg_count;
		this.male_neu_count=male_neu_count;
		this.female_pos_count=female_pos_count;
		this.female_neg_count=female_neg_count;
		this.female_neu_count=female_neu_count;
		this.fav_count=fav_count;
		this.retweet_count=retweet_count;
		this.device_mobile_count=device_mobile_count;
		this.device_pc_count=device_pc_count;
	}
}
