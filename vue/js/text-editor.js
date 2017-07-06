//https://developer.mozilla.org/fr/docs/Web/API/Document/execCommand
//https://developer.mozilla.org/fr/docs/Web/API/Document/designMode
        function iFrameOn(){
            richTextField.document.designMode = 'On';
        }
        function iBold(){
            richTextField.document.execCommand('bold',false,null); 
        }
        function iUnderline(){
            richTextField.document.execCommand('underline',false,null);
        }
        function iItalic(){
            richTextField.document.execCommand('italic',false,null); 
        }
        function iFontSize(){
            var size = prompt('Entrez une valeur entre 1 et 7 -- Autrement, la taille ne changera pas', '');
            richTextField.document.execCommand('FontSize',false,size);
        }
        function iForeColor(){
            var color = prompt('Donnez un code couleur en hexadecimal', '#');
            richTextField.document.execCommand('ForeColor',false,color);
        }
        function iHorizontalRule(){
            richTextField.document.execCommand('inserthorizontalrule',false,null);
        }
        function iUnorderedList(){
            richTextField.document.execCommand("InsertOrderedList", false,"newOL");
        }
        function iOrderedList(){
            richTextField.document.execCommand("InsertUnorderedList", false,"newUL");
        }
        function iLink(){
            var linkURL = prompt("Entrer l'URL du lien :", "http://"); 
            richTextField.document.execCommand("CreateLink", false, linkURL);
        }
        function iUnLink(){
            richTextField.document.execCommand("Unlink", false, null);
        }
        function submit_form(){
            var theForm = document.getElementById("textEditor");
            var content = theForm.elements["zone-saisie"].value;
            content = window.frames['richTextField'].document.body.innerHTML;
            theForm.elements["zone-saisie"].value = content.replace(/<|>|\//g, "*");
            
            theForm.submit();
        }