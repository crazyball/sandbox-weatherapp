describe('Tiles workflow', function() {
    beforeEach(function () {
        cy.visit('/');
        cy.contains('Se connecter').click();
        cy.get('input[name=_username]').type('admin');
        cy.get('input[name=_password]').type('admin{enter}');
    });
    it('will display no tiles', function() {
        cy.get('#card').should('not.exist');
    });
    it('will add a tile', function() {
        cy.contains('Administration').click();
        cy.contains('Ajouter').click();
        cy.get('input[name=city]').type('Montpellier');
        cy.get('input[name=latitude]').type('43.610769');
        cy.get('input[name=longitude]').type('3.8767159999999876{enter}');
        cy.url().should('include', '/fr/admin/cards');
        cy.contains('Tuile ajoutée avec succès.')
            .should('be.visible');
        cy.contains('Montpellier')
            .should('be.visible');
    });
    it('will display a tile', function() {
        cy.get('#tiles').contains('Montpellier');
    });
    it('will delete a tile', function() {
        cy.contains('Administration').click();
        cy.contains('Supprimer').click();
        cy.contains('Tuile supprimée avec succès.')
            .should('be.visible');
    });
});