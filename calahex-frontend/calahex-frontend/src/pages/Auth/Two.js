import React, { useEffect } from 'react';
import { useHistory } from "react-router-dom";
import { makeStyles } from '@material-ui/core/styles';
import { 
  Grid,
  Hidden
} from '@material-ui/core';
import TwoForm  from '../../components/Auth/TwoForm';
import ControlledAccordions from '../../components/Auth/ControlledAccordions';
import logoImg from "../../assets/logo.png";
import clsx from 'clsx';
import {GetNews} from '../../redux/actions/other'
import { connect } from 'react-redux';
import { UserTwo } from '../../redux/actions/auth';

// import jsonData from "../../resources/auth.json";

const useStyles = makeStyles(theme => ({
  root: {
    color: theme.palette.primary.main,
  },
  formContainer: {
    height: '100%',
    display: 'flex',
    flexDirection: 'column',
    alignItems: 'center',
    justifyContent: 'center',
    minHeight: `calc(100vh - ${theme.mixins.toolbar['@media (min-width:600px)'].minHeight}px)`,
    maxWidth: 500,
    [theme.breakpoints.down("sm")]: {
      maxWidth: '100%'
    },
  },
  title: {
    marginBottom: 20,
    fontWeight: 400,
    fontSize: 35,
    color: theme.palette.primary.main,
  },
  sider: {
    background: theme.palette.primary.main,
    minHeight: `calc(100vh - ${theme.mixins.toolbar['@media (min-width:600px)'].minHeight}px + 64px)`,
    display: 'flex',
    alignItems: 'center',
    paddingTop: '25%',
    flexDirection: 'column',
    color: 'white',
    [theme.breakpoints.up("md")]: {
      paddingTop: '10%'
    },
    [theme.breakpoints.down("xs")]: {
      paddingTop: '10%',
      paddingRight: 5,
      paddingLeft: 5
    },
  },
  siderTitle: {
    color: 'white',
    fontWeight: 400,
  },
  // logoImg: {
  //   marginBottom: theme.spacing(2)
  // },
  center: {
    textAlign: 'center',
    marginTop: 100,
  }
}));

const Two = (props) => {
  const classes = useStyles();
  // const { accordions } = jsonData;
  const { news, GetNews } = props;

  // let history = useHistory();
  useEffect(() => {
    GetNews();
  }, [])

  // useEffect(() => {
    
  //   if(typeof(props.location.state) == 'undefined') {
  //       history.push('login');
  //   } 
  //   // console.log(props.location.state);
  // },[]);
  return (
    <div className={classes.root}>
        <Grid container space={1}>
          <Hidden xsDown>
          <Grid item md={3} xs={4} className={classes.sider}>
            <h2 className={clsx(classes.siderTitle, classes.center)}>Calahex News</h2>
            {
                Object.keys(news).map((key, index) => {
                  return (
                      <ControlledAccordions key={index} keyword={`panel${index+1}`}  title={key} subitems={news[key].map(_new => ({text: _new}))} />
                  )
                })
              }
          </Grid>

          </Hidden>
          <Grid item md={2} sm={1} xs={1}/>
          <Grid item xs={10} sm={6} md={6}>
            <div className={classes.formContainer}>
              <h1 className={classes.title}>2FA authentication</h1>
              <TwoForm onSubmit={props.UserTwo} error={props.error}/>
            </div>
          </Grid>
        </Grid>
    </div>
  );
};

const mapStateToProps = state => ({
  news: state.other.news,
  error: state.auth.error,
});

const mapDispatchToProps = {
  GetNews,
  UserTwo
}

export default connect(mapStateToProps, mapDispatchToProps)(Two);
