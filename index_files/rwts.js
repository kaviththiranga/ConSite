var RW;
if (!this.RW) {
	// rw singleton and namespace
	RW = (function ()
	{

		/************************************************************
		 * Private methods
		 ************************************************************/

		/*
		 * Is property (or variable) defined?
		 */
		function isDefined(property)
		{
			return typeof property != 'undefined';
		}


		/*
		 * RW Tracker class
		 *
		 * trackerUrl and trackerCustId are optional arguments to the constructor
		 *
		 * See: Tracker.setTrackerUrl() and Tracker.setCustId()
		 */
		function Tracker(trackerUrl, custId)
		{
			/************************************************************
			 * Private members
			 ************************************************************/

			var	// Tracker URL
			configTrackerUrl = trackerUrl || '',

			// Cust ID
			configTrackerCustId = custId || '',

			// Client-side data collection
			pageReferrer,
			l_utm_source,
			l_utm_medium,
			l_utm_term,
			l_utm_content,
			l_utm_campaign,
			l_rw_src_offer_id,
			l_rw_offer_id,
			l_rw_rw_ext_id,
			l_rw_rw_sfa_id,

			// encode or escape
			escapeWrapper = window.encodeURIComponent || escape;


			 /**
			  * Submitting Request on servlet with help of a image 1x1 pixel
			  */
			 function getImage(url)
			{
				var now = new Date(),
				image = new Image(1, 1);
				image.onLoad = function () { };
				image.src = url;
			}
			 
			 
			 
			 /**
			  * parsing Url and getting Param value
			  */
			 function get_url_param(name)
			 {
				  name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
					 var regexS = "[\\?&]"+name+"=([^&#]*)";
					 var regex = new RegExp( regexS, "i" );
					 var results = regex.exec( window.location.href );
					 if( results == null )    return "";
					 else return results[1];					
			 }
			  /*Get value from document if present,pass the field name*/
			  function getValueFromDoc(fieldName)
			  {
			    var x=document.getElementsByName(fieldName);
			    var fieldValue="";
			    if(x.length>0)
			    {
			     fieldValue=(x[0].value);
			    }
			    
			    return fieldValue;
			  }

			 /**
			  * getting referrer url, where from this web page open
			  */
			function getReferrer()
			{
				return document.referrer;
			}


			/*
			 * Returns the URL to call servlet,
			 * with the standard parameters ( referer,utm_ fields etc.)
			 */
			function getRequest()
			{
				var is_cookie_enabled = (document.cookie) ? "true" : "false";
				 
				var  request;
				request = 
					'custid=' + configTrackerCustId 
			        +'&utm_source=' + escapeWrapper(l_utm_source) 
			        +'&utm_medium=' + escapeWrapper(l_utm_medium) 
			        +'&utm_term=' + escapeWrapper(l_utm_term) 
			        +'&utm_content=' + escapeWrapper(l_utm_content) 
			        +'&utm_campaign=' + escapeWrapper(l_utm_campaign) 
			        +'&rw_src_offer_id=' + escapeWrapper(l_rw_src_offer_id) 
			        +'&rw_offer_id=' + escapeWrapper(l_rw_offer_id) 
				    +'&urlref=' + escapeWrapper(pageReferrer)
				    +'&cookieenabled=' + escapeWrapper(is_cookie_enabled)
				    +'&rw_ext_id=' + escapeWrapper(l_rw_rw_ext_id)
				    +'&rw_sfa_id=' + escapeWrapper(l_rw_rw_sfa_id)
				    ;

				request =  configTrackerUrl + '?' + request;
				return request;
			}


			/*
			 * Get the web bug image (transparent single pixel, 1x1, image) to  visit in RW
			 */
			function getWebBug()
			{
				var request = getRequest();
				getImage(request);
			}


			/************************************************************
			 * Constructor
			 ************************************************************/

			/*
			 * initialize tracker
			 */
			pageReferrer = getReferrer();
			 


			//utm_source value----------------------
			try
			{
				if (typeof utm_source != 'undefined')
					l_utm_source=utm_source;
				else if (typeof Utm_Source != 'undefined')
					l_utm_source=Utm_Source;
				else if (typeof UTM_SOURCE != 'undefined')
					l_utm_source=UTM_SOURCE;
				else
					l_utm_source = get_url_param("utm_source");
				
			}catch(err)
			{
				l_utm_source="";
			}
			
			//utm_source value-------------------------
			try
			{
				if (typeof utm_medium != 'undefined')
					l_utm_medium=utm_medium;
				else if (typeof Utm_Medium != 'undefined')
					l_utm_medium=Utm_Medium;
				else if (typeof UTM_MEDIUM != 'undefined')
					l_utm_medium=UTM_MEDIUM;
				else
					l_utm_medium = get_url_param("utm_medium");
				
			}catch(err)
			{
				l_utm_medium = "";
			}			

			//utm_term value-------------------------
			try
			{
				if (typeof utm_term != 'undefined')
					l_utm_term=utm_term;
				else if (typeof Utm_Term != 'undefined')
					l_utm_term=Utm_Term;
				else if (typeof UTM_SOURCE != 'undefined')
					l_utm_term=UTM_TERM;
				else
					l_utm_term = get_url_param("utm_term");
			}catch(err)
			{
				l_utm_term = "";
			}				

			//utm_content--------------------------------
			try
			{
				if (typeof utm_content != 'undefined')
					l_utm_content=utm_content;
				else if (typeof Utm_Content != 'undefined')
					l_utm_content=Utm_Content;
				else if (typeof UTM_CONTENT != 'undefined')
					l_utm_content=UTM_CONTENT;
				else
					l_utm_content = get_url_param("utm_content");
			}catch(err)
			{
				l_utm_content = "";
			}

			//utm_campaign--------------------------------------
			try
			{
				if (typeof utm_campaign != 'undefined')
					l_utm_campaign=utm_campaign;
				else if (typeof Utm_Campaign != 'undefined')
					l_utm_campaign=Utm_Campaign;
				else if (typeof UTM_CAMPAIGN != 'undefined')
					l_utm_campaign=UTM_CAMPAIGN;
				else
					l_utm_campaign = get_url_param("utm_campaign");
			}catch(err)
			{
				l_utm_campaign = "";
			}

			//_src value---------------------------------------
			//first check in _SRC2, then check _src in url, then in document, then js variable.
			try
			{
				//first check src2
				//1.check in url
				l_rw_src_offer_id = get_url_param("_src2");
				if(l_rw_src_offer_id=="")
					l_rw_src_offer_id = get_url_param("_Src2");
				if(l_rw_src_offer_id=="")
					l_rw_src_offer_id = get_url_param("_SRC2");
				//2.check in html document
				if(l_rw_src_offer_id=="")
				{
					l_rw_src_offer_id=getValueFromDoc("_src2");
					if(l_rw_src_offer_id=="")
						l_rw_src_offer_id=getValueFromDoc("_Src2");
					if(l_rw_src_offer_id=="")
						l_rw_src_offer_id=getValueFromDoc("_SRC2");
				}
				//3.check in js vars
				if(l_rw_src_offer_id=="")
				{
					if (typeof _src2 != "undefined")
						l_rw_src_offer_id=_src2;
					else if (typeof _Src2 != 'undefined')
						l_rw_src_offer_id=_Src2;
					else if (typeof _SRC2 != 'undefined')
						l_rw_src_offer_id=_SRC2;
				}
				//checking src if src2 is not helpful
				if(l_rw_src_offer_id=="")
				{
					//1.check in url
					l_rw_src_offer_id = get_url_param("_src");
					if(l_rw_src_offer_id=="")
						l_rw_src_offer_id = get_url_param("_Src");
					if(l_rw_src_offer_id=="")
						l_rw_src_offer_id = get_url_param("_SRC");
					
					//2.check in html document
					if(l_rw_src_offer_id=="")
					{
						l_rw_src_offer_id=getValueFromDoc("_src");
						if(l_rw_src_offer_id=="")
							l_rw_src_offer_id=getValueFromDoc("_Src");
						if(l_rw_src_offer_id=="")
							l_rw_src_offer_id=getValueFromDoc("_SRC");
					}
					//3.check in js vars
					if(l_rw_src_offer_id=="")
					{
						if (typeof _src != "undefined")
							l_rw_src_offer_id=_src;
						else if (typeof _Src != 'undefined')
							l_rw_src_offer_id=_Src;
						else if (typeof _SRC != 'undefined')
							l_rw_src_offer_id=_SRC;
					}
				}
				
			}catch(err)
			{
				l_rw_src_offer_id = "";
			}

			//rw_ext_id value---------------------------------------
			//check in url, then in document, then js variable.
			try
			{
				//1.check in url
				l_rw_rw_ext_id = get_url_param("rw_ext_id");
				if(l_rw_rw_ext_id=="")
					l_rw_rw_ext_id = get_url_param("RW_EXT_ID");

				//2.check in html document
				if(l_rw_rw_ext_id=="")
				{
					l_rw_rw_ext_id=getValueFromDoc("rw_ext_id");
					if(l_rw_rw_ext_id=="")
						l_rw_rw_ext_id=getValueFromDoc("RW_EXT_ID");

				}
				//3.check in js vars
				if(l_rw_rw_ext_id=="")
				{
					if (typeof rw_ext_id != "undefined")
						l_rw_rw_ext_id=rw_ext_id;
					else if (typeof RW_EXT_ID != 'undefined')
						l_rw_rw_ext_id=RW_EXT_ID;

				}
				
			}catch(err)
			{
				l_rw_rw_ext_id = "";
			}	
			
			//rw_sfa_id value---------------------------------------
			//check in url, then in document, then js variable.
			try
			{
				//1.check in url
				l_rw_rw_sfa_id = get_url_param("rw_sfa_id");
				if(l_rw_rw_sfa_id=="")
					l_rw_rw_sfa_id = get_url_param("RW_SFA_ID");

				//2.check in html document
				if(l_rw_rw_sfa_id=="")
				{
					l_rw_rw_sfa_id=getValueFromDoc("rw_sfa_id");
					if(l_rw_rw_sfa_id=="")
						l_rw_rw_sfa_id=getValueFromDoc("RW_SFA_ID");

				}
				//3.check in js vars
				if(l_rw_rw_sfa_id=="")
				{
					if (typeof rw_sfa_id != "undefined")
						l_rw_rw_sfa_id=rw_sfa_id;
					else if (typeof RW_SFA_ID != 'undefined')
						l_rw_rw_sfa_id=RW_SFA_ID;

				}
				
			}catch(err)
			{
				l_rw_rw_sfa_id = "";
			}				
			//_ao value----------------------------------------
			try
			{
				if (typeof _ao != 'undefined')
					l_rw_offer_id=_ao;
				else if (typeof _Ao != 'undefined')
					l_rw_offer_id=_Ao;
				else if (typeof _AO != 'undefined')
					l_rw_offer_id=_AO;
				else
					l_rw_offer_id = get_url_param("_AO");
			}catch(err)
			{
				l_rw_offer_id = "";
			}



			/************************************************************
			 * Public data and methods
			 ************************************************************/

			return {

				/*
				 * Specify the RW server URL
				 */
				setTrackerUrl: function (trackerUrl)
				{
					if (isDefined(trackerUrl))
					{
						configTrackerUrl = trackerUrl;
					}
				},

				/*
				 * Specify the cust ID
				 */
				setCustId: function (custId)
				{
					if (isDefined(custId))
					{
						configTrackerCustId = custId;
					}
				},

				/*
				 * visit to this page
				 */
				trackPageView: function ()
				{
					getWebBug();
				}

			};
		}


		/************************************************************
		 * Public data and methods
		 ************************************************************/

		return {

			/*
			 * Get Tracker
			 */
			getTracker: function (rwUrl, custId)
			{
					return new Tracker(rwUrl, custId);
			}
		};
	}());
	
	
	/*
	 * Track page visit
	 */
	rw_log = function (rwUrl, custId)
	{


		rwUrl=rwUrl + "RWTs";
		try {
			// instantiate the tracker
			var rwTracker = RW.getTracker(rwUrl, custId);
			// track this page view
			rwTracker.trackPageView();
		} catch (e) {
			// TODO: handle exception
		}

	};
}
