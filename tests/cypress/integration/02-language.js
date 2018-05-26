describe('Language Features', function() {
    it('switch site to english', function() {
        cy.visit('/fr');
        cy.contains('Anglais')
            .click();
        cy.url()
            .should('include', '/en');
        cy.contains('English')
            .should('be.visible');
    });
    it('switch site to french', function() {
        cy.visit('/en');
        cy.contains('French')
            .click();
        cy.url()
            .should('include', '/fr');
        cy.contains('Francais')
            .should('be.visible');
    });
    it('keep url when change lang', function() {
        cy.visit('/');
        cy.contains('Se connecter').click();
        cy.contains('Anglais')
            .click();
        cy.url()
            .should('include', '/en/login');
    });
});