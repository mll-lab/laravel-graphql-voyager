<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset=utf-8 />
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui">
    <title>GraphQL Voyager</title>

    <style>
        body {
            height: 100%;
            margin: 0;
            width: 100%;
            overflow: hidden;
        }
        #voyager {
            height: 100vh;
        }
    </style>

    <script src="{{\MLL\GraphQLVoyager\DownloadAssetsCommand::reactPath()}}"></script>
    <script src="{{\MLL\GraphQLVoyager\DownloadAssetsCommand::reactDomPath()}}"></script>

    <link rel="stylesheet"
          href="{{\MLL\GraphQLVoyager\DownloadAssetsCommand::cssPath()}}"
    />
    <link rel="shortcut icon"
          href="{{\MLL\GraphQLVoyager\DownloadAssetsCommand::faviconPath()}}"
    />
    <script src="{{\MLL\GraphQLVoyager\DownloadAssetsCommand::jsPath()}}"></script>
</head>

<body>

<div id="voyager">Loading...</div>
<script type="text/javascript">
    const endpoint = <?php $endpoint = config('graphql-voyager.endpoint');
    echo is_string($endpoint)
        ? "'{$endpoint}'"
        : 'null'; ?>

    GraphQLVoyager.init(document.getElementById('voyager'), {
        introspection: endpoint
            ? fetch(endpoint, {
                method: 'post',
                headers: {
                    Accept: 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ query: GraphQLVoyager.voyagerIntrospectionQuery }),
                credentials: 'include',
            }).then((response) => response.json())
            : undefined,
    });
</script>

</body>
</html>
