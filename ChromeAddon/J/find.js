function findJobs(info, tab) {
   chrome.tabs.create({'url': 'http://employmentforjobs.com/find:' + info.selectionText}, function(tab) {
   });
}

var id = chrome.contextMenus.create({"title": 'Look for jobs on that keyword', "contexts":["selection"], "onclick": findJobs});