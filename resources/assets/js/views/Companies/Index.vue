<template>
	<list-view
		title="Companies"
		url="/companies"
		resource="companies"
		:searchFields="searchFields"
		:listRows="listRows"
		:sortBy="sortBy"
	/>
</template>

<script>
import listView from '../../components/listView'

export default {
  	components: {
		listView
	},
	data() {
		return {
			sortBy: 'name',
			searchFields: [
				{ 'field': 'name', 'class': 'col-xs-5'},
				{ 'field': 'dni', 'class': 'col-xs-5'},
				{ 'field': 'contact_name', 'class': 'col-xs-5'}
			],
			listRows: [
					{ 
						'id': 1, 'showFields': [
							{ 'field': 'name', 'class': 'col-xs-5'},
							{ 'field': 'dni', 'class': 'col-xs-3'},
							{ 'field': 'contact_name', 'class': 'col-xs-4'},
						]
					},
					{ 
						'id': 1, 'showFields': [
							{ 'field': 'email', 'class': 'col-xs-12'},	
						]
					},
					{ 
						'id': 1, 'showFields': [
							{ 'field': 'phone', 'class': 'col-xs-12'}	
						]
					}
			],
		}
	}
}
</script>
