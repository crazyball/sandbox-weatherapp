describe('Infrastructure', function() {
    it('Homepage responding', function() {
        cy.visit('/');
        cy.contains('Application météo ');
    });
    it('no route found will return error', function() {
        cy.request({'failOnStatusCode': false, 'url': '/blablabla'}).then((response) => {
            expect(response.status).to.eq(404);
        });
    });
});

