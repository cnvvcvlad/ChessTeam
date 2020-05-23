// creation du composant React de la librairie
// Acces au ReactDOM

// creation d'une classe ES6
class LikeButton extends React.Component {

    // creation du constructeur qui recoit des props
    constructor(props) {
        // on appelle le constructeur de la classe parente en lui passant les props
        super(props);

            ////mettre en place un state, c'est un objet
            this.state = {
                //on defini les proprietes qui viennent de props, nombre de likes, si on n'a rien alors c'est 0
                likes: props.likes || 0,
                //propriete isLiked, false par defaut
                isLiked: props.isLiked || false
            };
        }

    handleClick() {
        //requete AJAX qui va prevenir le serveur que j'aime cet article ou je ne l'aime plus
         console.log(this);

            const isLiked = this.state.isLiked;
            const likes = +this.state.likes + (isLiked ? -1 : 1);

        this.setState({
            likes: likes,
            isLiked: !isLiked
        }); // la données que j'ai actuellement va etre inversé

    }


    render() {
        // creation d'un element React, en HTML, un bouton avec une class
        return React.createElement("a",

            {
                className: "",
                onClick: () => this.handleClick()
            }, // lorsqu'on fait du binding, on sorte de contexte de l'objet, on utilise  la "zero" function
            this.state.likes, " ",
            React.createElement('i', {className: this.state.isLiked ? "fas fa-thumbs-up" : "far fa-thumbs-up"}),
            " ", // ajout d'un espace entre les elements
            this.state.isLiked ? "Je n'aime plus !" : "J'aime !" // on ecrit une ternaire , on pose la question : si notre article a ete liké (true) alors je n'aime plus, et l'inverse...
        );
    }
}

// on indique le lieux exacte de notre element React
// on a un nod list (un tableau de valeurs que l'on a recuperé depuis notre base de données en PHP), stocké dans les datasets
document.querySelectorAll('span.react-like').forEach(function (span) {
    const likes = +span.dataset.likes; // on definit le + pour que c'est un nombre
    const isLiked = +span.dataset.isLiked === 1; // data-is-liked <=> dataset.isLiked , cela se met true ou false et se met dans isLiked

//Chaque élément JSX n'est qu'un sucre syntaxique pour l'appel React.createElement(component, props, ...children). Donc, tout ce que vous pouvez faire avec JSX peut également être fait avec du JavaScript simple.
    ReactDOM.render(React.createElement(LikeButton, {likes: likes, isLiked: isLiked}), span);
});