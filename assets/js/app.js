/**
 * função messenger(): verifica se tem uma mensagem setada (pelo backend) em um cookie chamado "we_b_operation_response"
 * se tiver exibe e apaga esse cookie, se não, não faz nada
*/
function messenger()
{
    let cookiesInBrowser = document.cookie

    let cookieMessageName = 'we_b_operation_response='

    let cookieMessageIndex = cookiesInBrowser.indexOf(cookieMessageName)

    if (cookieMessageIndex !== -1) /** significa que existe uma mensagem setada via cookie */
    {
        let cookieFirstString = cookiesInBrowser.substring(cookieMessageIndex, cookiesInBrowser.length)

        /** se achar um ; (ponto-e-virgula) significa que tem mais cookies pra frente, se não, era o último cookie da lista */
        let endCookie = cookieFirstString.indexOf(';')

        /** A chave e o valor do cookie como string */
        let cookieMessageKeyValueString = endCookie !== -1 ? cookieFirstString.substring(0, endCookie) : cookieFirstString

        /** salva o nome da chave do cookie */
        let cookieKey = cookieMessageKeyValueString.split('=') [ 0 ]
        /** salva o valor do cookie antes de deletar */
        let cookieValue = cookieMessageKeyValueString.split('=') [ 1 ]

        window.alert(cookieValue)

        /** deleta o cookie */
        let expired = new Date(2000,10,1).toGMTString()
        document.cookie = `we_b_operation_response=; expires=${expired}; path=/`
    }
}


messenger()