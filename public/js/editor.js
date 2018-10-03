// get the container for the editor, the edit and the save button
let alertBox = $('#alertBox')
let $container = $('#jsoneditor')

alertBox.hide()
$container.hide()
$('.action-buttons').hide()

let saveSettingsButton = $('#saveSettings')
let container = document.getElementById('jsoneditor')

// get the initial json and game id
let game = null
let json = null
const csrf = __CSRF__TOKEN__

let editor = new JSONEditor(container)


/**
 * Set the button to loading state
 * @return {null}
 */
function setLoading() {
  saveSettingsButton.prop('disabled', true)
  saveSettingsButton.html('Saving ...')
}

/**
 * Show the json editor
 */
function showEditor() {
  // create a new editor instance
  editor.set(json)
  
  $container.show()
}

function cancelEditing() {
  $container.hide()
  json = null
  game = null

  $('.edit-button').prop('disabled', false)
  $('.action-buttons').hide()

  editor.set(json)
}


/**
 * handle the edit settings action.
 * @param {string} gameId the id of the game under edit
 * @param {object} settings the settings of the game.
 */
function handleEditSettings(gameId, settings) {
  game = gameId
  json = settings
  showEditor()
  // hide the other edit buttons to prevent further editing.
  $('.edit-button').prop('disabled', true)
  $('.action-buttons').show()
}

/**
 * Set the button back to default state
 * @return {null}
 */
function unsetLoading() {
  saveSettingsButton.prop('disabled', false)
  saveSettingsButton.html('Save Settings')
}

/**
 * We need to reset onclick arguments so admin can see updated data
 * @param {object} settings the newly updated settings from database.
 */
function resetGameSettings(settings) {
  const button = $(`#editSettings-${game}`)
  const code = $(`#gameSettings-${game}`)
  code.text(settings)
  button.attr('onclick', `handleEditSettings(${game}, ${settings})`)
}

/**
 * Takes a message and displays in an alert.
 * @param {string} message
 * @returns {null}
 */
function showAlert(message, type = 'success') {
  // remove all classes
  alertBox.removeClass()

  // set the message on the box and add the relevant classes
  alertBox.html(message).addClass(`alert alert-${type}`)

  // show the alert box
  alertBox.show()

  // hide the alert box 2seconds later.
  setTimeout(() => {
    alertBox.hide()
  }, 2000)
}
/**
 * Handle successful settings save.
 * @param {Object}data the data from the server.
 */
function success(data) {
  unsetLoading()
  resetGameSettings(data.game.settings)
  cancelEditing()
  // show success results.
  showAlert(data.message)
}

/**
 * Handle the errors from the server.
 * @param {Object} data
 * @return null
 */
function error(data) {
  unsetLoading()
  cancelEditing()
  showAlert(data.responseJSON.message, 'danger')
}

/**
 * Make the ajax request to the server to save settings.
 * @param {Object} data the data to send to the server.
 */
function saveSettings(data) {
  $.ajax({
    type: 'POST',
    url: `/games/${game}`,
    data: {
      ...data,
      _method: 'PUT',
      _token: csrf
    },
    success,
    error,
  })
}

$('#cancelEditing').on('click', cancelEditing)

// registerr the click event listener, and make an api request to save settings.
$('#saveSettings').on('click', () => {
  setLoading()
  saveSettings(editor.get())
})
