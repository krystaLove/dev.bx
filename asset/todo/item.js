export class Item
{
	title;
	deleteButtonHandler;
	onItemUpdatedHandler;

	isEditing = false;

	constructor({title, deleteButtonHandler, onItemUpdatedHandler})
	{
		this.title = String(title);

		if (typeof deleteButtonHandler === 'function')
		{
			this.deleteButtonHandler = deleteButtonHandler;
		}

		if(typeof onItemUpdatedHandler === 'function')
		{
			this.onItemUpdatedHandler = onItemUpdatedHandler
		}
	}

	getData()
	{
		return {title: this.title};
	}

	render()
	{
		this.isEditing = false

		const container = document.createElement('div');
		container.classList.add('item-container');

		const title = document.createElement('div');
		title.classList.add('item-title');
		title.innerText = this.title;

		const editTitle = document.createElement('input')
		editTitle.classList.add("calendar-edit-item-title")
		editTitle.classList.add('hidden')

		container.append(editTitle)
		container.append(title);

		const buttonsContainer = document.createElement('div');
		const deleteButton = document.createElement('button');

		deleteButton.innerText = 'Delete';
		buttonsContainer.append(deleteButton);
		deleteButton.addEventListener('click', this.handleDeleteButtonClick.bind(this));

		const editButton = document.createElement('button');
		editButton.classList.add('item-button-edit')
		editButton.innerText = 'Edit';
		editButton.addEventListener('click', this.handleEditButtonClick.bind(this, container));

		buttonsContainer.append(editButton);

		container.append(buttonsContainer);

		return container;
	}

	handleDeleteButtonClick()
	{
		if (this.deleteButtonHandler)
		{
			this.deleteButtonHandler(this);
		}
	}

	handleEditButtonClick(container)
	{
		this.#switchEditingMode(container)
	}

	#switchEditingMode(container)
	{
		const title = container.querySelector('.item-title')
		const editTitle = container.querySelector('.calendar-edit-item-title')
		const editButton = container.querySelector('.item-button-edit')

		if(!title || !editTitle || !editButton)
		{
			return
		}

		if(!this.isEditing)
		{
			editButton.innerText = 'Save'
			editTitle.value = title.innerText
			title.classList.add('hidden')
			editTitle.classList.remove('hidden')
		}
		else
		{
			editButton.innerText = 'Edit'
			title.classList.remove('hidden')
			editTitle.classList.add("hidden")
			title.innerText = editTitle.value

			// Calling callback to save list with updated item on server
			if(this.title !== title.innerText)
			{
				this.title = title.innerText
				this.onItemUpdatedHandler()
			}
		}

		this.isEditing = !this.isEditing
	}
}