describe('Login Features', function() {
    it('redirects to / on success', function() {
        cy.visit('/');
        cy.contains('Se connecter').click();
        cy.get('input[name=_username]').type('admin');
        cy.get('input[name=_password]').type('admin{enter}');
        cy.url()
            .should('include', '/fr');
        cy.contains('Se déconnecter')
            .should('be.visible');
    });
    it('displays errors on wrong login', function(){
        cy.visit('/');
        cy.contains('Se connecter').click();
        cy.get('input[name=_username]').type('wrongusername');
        cy.get('input[name=_password]').type('wrongpassword{enter}');
        cy.get('.panel-body')
            .should('be.visible')
            .and('contain', 'Identifiants invalides.');
        cy.url().should('include', '/login');
    });
    it('will redirect to login if trying to access restricted page', function(){
        cy.visit('/fr/admin/cards');
        cy.url().should('include', '/login');
    });
});