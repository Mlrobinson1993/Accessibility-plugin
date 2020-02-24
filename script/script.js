window.addEventListener('DOMContentLoaded', function() {
	console.log('scripts loaded');
	const listContainer = document.querySelector('.list-container');
	const errorContainer = document.querySelector('.error-container');
	const spinner = document.querySelector('.spinner');

	document.querySelector('.a11y-page-btn').addEventListener('click', init);

	function init() {
		getData();
	}

	function getData() {
		//remove previous errors from container
		removeChildren();

		//show loading spinner
		spinner.classList.add('is-active');
		const url = window.location.host;
		const apiKey = 'WRve4SjU1458';
		const textMatch = 'localhost';
		const numMatch = '127.0.0.1';
		console.log('getting data');
		if (
			window.location.host.includes(textMatch) ||
			window.location.host.includes(numMatch)
		) {
			const error = {
				statistics: {
					allitemcount: '',
					pageurl: 'Not available in local environments',
					totalelements: '',
				},
			};

			spinner.classList.remove('is-active');
			displayHeaderData(error);
			return false;
		} else {
			fetch(
				`https://wave.webaim.org/api/request?key=${apiKey}&reporttype=4&url=${url}`
			)
				.then(function(response) {
					response.json().then(function(data) {
						spinner.classList.remove('is-active');
						displayHeaderData(data);
						displayListData(data);
					});
				})
				.catch(function(err) {
					console.error(err);
				});
		}
	}

	//data = full object of data from API call
	//condense full API data into the 6 available error categories
	function sortListData(data) {
		const {
			error,
			alert,
			contrast,
			feature,
			structure,
			aria,
		} = data.categories;

		const listData = [
			{ ...error },
			{ ...alert },
			{ ...contrast },
			{ ...feature },
			{ ...structure },
			{ ...aria },
		];

		return listData;
	}

	//extract individual error instances from data, return array of error instances
	function sortSubListData(object) {
		const subListArray = Object.values(object);
		return subListArray;
	}

	function calcScore(errors, count) {
		//get percentage of errors from total elements
		const result = parseInt((count / errors) * 100);
		//set result to -0 if args are text(should only happen if on localhost or on error)
		if (isNaN(result)) {
			result = 0;
		}
		return result + "% of your website's elements are accessible";
	}

	function displayHeaderData(data) {
		//allitemcount: total number of errors
		//pageurl: url of page
		//totalelements: total number of elements in the DOM tree
		const { allitemcount, pageurl, totalelements } = data.statistics;
		//grab header nodes
		const urlNode = document.querySelector('.page-url .light');
		const errorsNode = document.querySelector('.accessibility-errors .light');
		const scoreNode = document.querySelector('.accessibility-score');
		//amend data to header nodes
		urlNode.textContent = pageurl;
		scoreNode.textContent = calcScore(totalelements, allitemcount);
		errorsNode.textContent = `${allitemcount} errors in ${totalelements} elements.`;
	}

	//grow list item to show sublist items on click
	listContainer.addEventListener('click', function(e) {
		enlargeListItem(e);
	});

	//bubble event from children to the parent element to enlarge list items on click
	//if element clicked is 'show me more' button, error and error locations are shown in error container
	function enlargeListItem(e) {
		if (e.target.tagName === 'LI') {
			e.target.parentNode.classList.toggle('list-enlarged');
		} else if (e.target.tagName === 'P' || e.target.tagName === 'SPAN') {
			e.target.parentNode.parentNode.classList.toggle('list-enlarged');
		} else if (e.target.classList.contains('list_item-button')) {
			showErrorLocation(e);
		}
	}

	//object = full object data retreived from API
	function displayListData(object) {
		//extract
		const list = sortListData(object);

		/* for each item in list
				  create a new UL (error category)
			-	append individual errors to error category
			-	append individual error instances to individual errors
		*/
		list.forEach(function(data) {
			//create and append UL
			const list = createList();
			appendElement(listContainer, list);

			const listItem = createListItem();
			appendElement(list, listItem);

			const textNodes = addTextNodes(
				data.description,
				data.count,
				'Click me to learn more',
				undefined
			);

			textNodes.forEach(function(node) {
				if (node) {
					appendElement(listItem, node);
				} else {
					return;
				}
			});

			const subListData = sortSubListData(data.items);
			displaySubListData(subListData, list);
		});
	}

	function displaySubListData(data, parent) {
		data.forEach(function(obj) {
			const { selectors, id, count, description } = obj;

			//parent: error category
			const listItem = createListItem();
			appendElement(parent, listItem);

			//remove underscore from selector ID
			const splitId = id.split('_').join(' ');

			//create text node and append to each individual error instance
			const textNodes = addTextNodes(splitId, count, description, selectors);

			textNodes.forEach(function(node) {
				if (Array.isArray(node)) {
					node.forEach(function(item) {
						appendElement(listItem, item);
					});
				} else {
					appendElement(listItem, node);
				}
			});

			//parameter 1: classList
			//parameter 2: button text
			//creates button to open selector trace
			const button = createButton(
				'list_item-button button-primary',
				'Show me where'
			);
			appendElement(listItem, button);
		});
	}

	/*
		duplicates event target(list item) on click
	appends duplicated node to right side container
	hides 'show me where' button
	displays individual error locations
		*/

	function showErrorLocation(e) {
		const node = e.target.parentNode;
		const clonedNode = node.cloneNode(true);
		const children = clonedNode.childNodes;

		const listItems = Array.from(children).filter(function(node) {
			if (node.tagName === 'LI') {
				return node;
			}
		});

		listItems.forEach(function(item) {
			item.classList.remove('hidden');
		});

		children[children.length - 1].classList.add('hidden');

		clonedNode.classList.add('full-height');
		errorContainer.innerHTML = '';
		appendElement(errorContainer, clonedNode);
	}

	//utility functions

	function appendElement(parent, child) {
		parent.appendChild(child);
	}

	function createButton(classList, btnText) {
		const button = document.createElement('button');
		button.classList = 'list_item-button button-primary';
		button.textContent = 'Show me where';
		return button;
	}

	function createList() {
		const list = document.createElement('ul');
		list.classList.add('list');
		return list;
	}

	function createListItem() {
		const listItem = document.createElement('li');
		listItem.classList.add('list-item');
		return listItem;
	}

	/*
create LI for error location instance
append selector if available, error string if not
*/
	function createSelector(selector) {
		const selectorNode = createListItem();
		selectorNode.textContent = selector;
		selectorNode.classList.add('hidden');
		return selectorNode;
	}

	/*
	push individual error location intances into an array
	loop through and append them to the parent list
	*/
	function createSelectorArray(selectors) {
		const selectorsArray = [];
		const list = createList();
		selectors.forEach(function(selector) {
			if (selector !== false) {
				const selectorNode = createSelector(selector);
				selectorsArray.push(selectorNode);
				appendElement(list, selectorNode);
			} else {
				const selectorNode = createSelector('No trace available');
				selectorsArray.push(selectorNode);
				appendElement(list, selectorNode);
			}
		});
		return selectorsArray;
	}

	/*
	creates text nodes for individual errors
	if the error contains location instances:
	returns all text nodes + text nodes for error instances
	if not:
	returns all text nodes
	*/
	function addTextNodes(id, count, description, selectors) {
		const idNode = document.createElement('span');
		idNode.classList.add('id');

		const idText = document.createTextNode(id + ': ');
		appendElement(idNode, idText);

		const countNode = document.createElement('span');
		countNode.classList.add('count');

		const countText = document.createTextNode(count);
		appendElement(countNode, countText);

		const descriptionNode = document.createElement('p');
		descriptionNode.classList.add('description');
		descriptionNode.textContent = description;

		if (selectors) {
			const selectorsArray = createSelectorArray(selectors);
			return [idNode, countNode, descriptionNode, selectorsArray];
		}

		return [idNode, countNode, descriptionNode];
	}

	//I nearly accidentally called this function kill children (woops).
	//grabs all children of the list container and deletes them if
	//they are a UL or an LI - returns if none present
	function removeChildren() {
		const children = Array.from(listContainer.childNodes);
		if (children.length > 0) {
			children.forEach(function(node) {
				if (node.tagName === 'UL' || node.tagName === 'LI') {
					listContainer.removeChild(node);
				}
			});
		} else {
			return false;
		}
	}
});
