const articleList = []; // In a real app this list would be full of articles.
var kudos = 5;

function calculateTotalKudos() {
  return articleList.reduce((tmp, article) => tmp + article.kudos, 0);
}

document.write(`
  <p>Maximum kudos you can give to an article: ${kudos}</p>
  <p>Total Kudos already given across all articles: ${calculateTotalKudos()}</p>
`);
