isc.defineClass("ERS_Dashboard", isc.HTMLPane).addProperties({
	 width: '100%',
	 height: '100%',
	 overflow: 'visible',
	 
	 contentsType: 'page',
	 contentsURL: 'web/org.openbravo.sangkuriang.executivereporting/jsp/dashboard.jsp',
	 
	// allow only open one tab for this tab instance
	 isSameTab: function (viewId, params) {
		 return viewId === this.getClassName();
	 },
	 
	getBookMarkParams: function () {
		 var result = {};
		 result.viewId = this.getClassName();
		 result.tabTitle = this.tabTitle;
		 return result;
	}
});